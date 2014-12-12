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
		$message = "Fighting...";
		//ok. I got a hero, and an enemy. Let's make them fight and then calculate the results.
		//TODO let's define how a fight occurs

		
		
		$damage_taken = 0.5 * $hero->getHP(); //Let's suppose i lose 20% of my hp in battle
		$message .= "<br/>Win!";
		
		//let's define the latency before being able to perform another fight
		$secs = floor($damage_taken * self::REGEN_RATE + self::REST_CONST); 
		$date = new \DateTime();
		$date->add(new DateInterval("PT" . $secs . "S"));
		$hero->setNextFight($date);
		
		//let's define the exp obtained in case of win
		$exp = floor($hero->getMaxExp() / ($hero->getLevel()*self::LEVEL_MULTIPLIER));
		$hero->setExp($hero->getExp()+$exp);
		$message .= "<br/>You won $exp exp";
		return $message;
	}
	
	//Checks if an hero can fight again and, otherwise, calculate how many seconds it has to wait
	public function checkSecs($hero) {
		$now = new \DateTime();
		$then = $hero->getNextFight();
		$diff = $then->getTimestamp() - $now->getTimestamp();
		
		if ($diff > 0) 
			return $diff;
		return 0;
	}
}