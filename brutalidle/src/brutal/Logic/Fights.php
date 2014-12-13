<?php

namespace brutal\Logic;

use \DateTime;
use \DateInterval;

class Fights 
{
	/* EXP FORMULA:
	 * In order to make a level, I need to win LEVEL_MULTIPLIER fights more than in the previous level.
	 * So, Let's just calculate maxExp and divide it by LEVEL_MULTIPLIER * Level.
	 * * * */
	const LEVEL_MULTIPLIER = 9; //If 10, I would have no benefit AT ALL in lvling up, in terms of EXP! 
								//Let's keep the benefit to the bare minimum... just b/c you know, this has to be frustrating after all!
	const REGEN_RATE = 1; //Every HP I lose, I have to wait for a second.
	const REST_CONST = 5; //Regardless from the damage, let's wait for some secs anyways
	
	//Simulate a fight
	public function fight($hero, $enemy) 
	{
		$this->msg_init("Fighting...");
		//ok. I got a hero, and an enemy. Let's make them fight and then calculate the results.
		//TODO let's define how a fight occurs
		$hero_hp = $hero->getHP();
		$enemy_hp = $enemy->getHP();
		while ($hero_hp>0 && $enemy_hp>0) 
		{
			list($hero_hp, $enemy_hp) = $this->attack($hero_hp, $hero, $enemy_hp, $enemy);	
		}
		
		
		if ($hero_hp > 0) 
		{
			//Let's calculate the damage taken
			$damage_taken = $hero->getHP() - $hero_hp;
			$this->msg_post("You won!");
			
			//let's define the latency before being able to perform another fight
			$secs = floor($damage_taken * self::REGEN_RATE + self::REST_CONST);
			$date = new \DateTime();
			$date->add(new DateInterval("PT" . $secs . "S"));
			$hero->setNextFight($date);

			//let's define the exp obtained in case of win
			$exp = floor($hero->getMaxExp() / ($hero->getLevel()*self::LEVEL_MULTIPLIER));
			$hero->setExp($hero->getExp()+$exp);
			$this->msg_post("You earned $exp exp points");
		} else {
			//Let's calculate the damage taken
			$damage_taken = $hero->getHP();
			$this->msg_post("You lost!");
				
			//let's define the latency before being able to perform another fight
			$secs = floor($damage_taken * self::REGEN_RATE + self::REST_CONST);
			$date = new \DateTime();
			$date->add(new DateInterval("PT" . $secs . "S"));
			$hero->setNextFight($date);
		}
		
		return $this->msg_get();
	}
	
	//Checks if an hero can fight again and, otherwise, calculate how many seconds it has to wait
	public function checkSecs($hero) {
		$now = new \DateTime();
		$then = $hero->getNextFight();
		if ($then == null) 
			return 0;
		$diff = $then->getTimestamp() - $now->getTimestamp();
		
		if ($diff > 0) 
			return $diff;
		return 0;
	}
	
	private function attack($hero_hp, $hero, $enemy_hp, $enemy) 
	{
		//Every round works in this way:
		//at first, $hero_hp and $enemy_hp gets boosted by armor
		//then, preemptive attack occurs: the one with the highest value hits the other dam = preATK-preDEF
		//finally, normal attacks occur: depending on the difference in speed, the fastest one hits one or more times the other
		//if anyone dies in between, the fight is over.
		
		//Base stats
		$h_hp = $hero_hp + $hero->getArmor();
		$e_hp = $enemy_hp + $enemy->getArmor();

		//Preemptive attacks
		$h_pre = $hero->getPreempt();
		$e_pre = $enemy->getPreempt();
		
		$this->msg_post("Round starts [$h_hp vs $e_hp]");
		
		if ($h_pre > $e_pre) {
			$e_hp -= $h_pre-$e_pre;
			$this->msg_post("Hero performs a preemptive attack for " . ($h_pre-$e_pre));
		} else if ($h_pre < $e_pre) {
			$h_hp -= $e_pre-$h_pre;
			$this->msg_post("Enemy performs a preemptive attack for " . ($e_pre-$h_pre));
		}

		if ($h_hp > 0 && $e_hp > 0)
		{
			$this->msg_post("Fight starts [$h_hp vs $e_hp]");
			
			//Regular attacks
			$base_hspeed = $hero_speed = $hero->getSpeed();
			$base_espeed =$enemy_speed = $enemy->getSpeed();
			
			while ($hero_speed > 0 && $enemy_speed > 0 && $h_hp > 0 && $e_hp > 0) 
			{
				if ($hero_speed > $enemy_speed) 
				{
					if ($enemy_speed > 0) 
					{
						$hero_speed-=$base_espeed;
					} else 
						$hero_speed = -1;
					$dmg = $hero->getDamage(); 
					$e_hp-= $dmg;
					$this->msg_post("Hero attacks for $dmg [$h_hp vs $e_hp]");
				} 
				else 
				{
					if ($hero_speed > 0)
						$enemy_speed-=$base_hspeed;
					else
						$enemy_speed = -1;
					$dmg = $enemy->getDamage();
					$h_hp -= $dmg;
					$this->msg_post("Enemy attacks for $dmg [$h_hp vs $e_hp]");
				}
			}
		}
		//Avoid healing from armor
		if ($h_hp > $hero_hp)  $h_hp = $hero_hp;
		if ($e_hp > $enemy_hp) $e_hp = $enemy_hp;
		
		$this->msg_post("End of round. Hero hp: $h_hp, enemy hp: $e_hp");
		return array($h_hp, $e_hp);
	}
	
	private $message;
	private function msg_init($string) {
		$this->message = $string;
	}
	private function msg_post($string) {
		$this->message .= "<br/>$string";
	}
	private function msg_get() {
		return $this->message;
	}
}