<?php

namespace brutal\DbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hero
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="brutal\DbBundle\Entity\HeroRepository")
 */
class Hero
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="str", type="integer")
     */
    private $str;

    /**
     * @var integer
     *
     * @ORM\Column(name="dex", type="integer")
     */
    private $dex;

    /**
     * @var integer
     *
     * @ORM\Column(name="mnd", type="integer")
     */
    private $mnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="str_inc", type="integer")
     */
    private $strInc;

    /**
     * @var integer
     *
     * @ORM\Column(name="dex_inc", type="integer")
     */
    private $dexInc;

    /**
     * @var integer
     *
     * @ORM\Column(name="mnd_inc", type="integer")
     */
    private $mndInc;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer")
     */
    private $exp;

    /**
     * @var datetime
     *
     * @ORM\Column(name="nextFight", type="datetime", nullable=true)
     */
    private $nextFight;
    
    /**
     * @var integer
     * 
     * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="owner", referencedColumnName="id", nullable=true)
     */
    private $owner;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Hero
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Hero
     */
    public function setType($type)
    {
    	$this->type = $type;
    
    	return $this;
    }
    
    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
    	return $this->type;
    }
    
    /**
     * Set str
     *
     * @param integer $str
     * @return Hero
     */
    public function setStr($str)
    {
        $this->str = $str;

        return $this;
    }

    /**
     * Get str
     *
     * @return integer 
     */
    public function getStr()
    {
        return $this->str;
    }

    /**
     * Set dex
     *
     * @param integer $dex
     * @return Hero
     */
    public function setDex($dex)
    {
        $this->dex = $dex;

        return $this;
    }

    /**
     * Get dex
     *
     * @return integer 
     */
    public function getDex()
    {
        return $this->dex;
    }

    /**
     * Set mnd
     *
     * @param integer $mnd
     * @return Hero
     */
    public function setMnd($mnd)
    {
        $this->mnd = $mnd;

        return $this;
    }

    /**
     * Get mnd
     *
     * @return integer 
     */
    public function getMnd()
    {
        return $this->mnd;
    }

    /**
     * Set strInc
     *
     * @param integer $strInc
     * @return Hero
     */
    public function setStrInc($strInc)
    {
        $this->strInc = $strInc;

        return $this;
    }

    /**
     * Get strInc
     *
     * @return integer 
     */
    public function getStrInc()
    {
        return $this->strInc;
    }

    /**
     * Set dexInc
     *
     * @param integer $dexInc
     * @return Hero
     */
    public function setDexInc($dexInc)
    {
        $this->dexInc = $dexInc;

        return $this;
    }

    /**
     * Get dexInc
     *
     * @return integer 
     */
    public function getDexInc()
    {
        return $this->dexInc;
    }

    /**
     * Set mndInc
     *
     * @param integer $mndInc
     * @return Hero
     */
    public function setMndInc($mndInc)
    {
        $this->mndInc = $mndInc;

        return $this;
    }

    /**
     * Get mndInc
     *
     * @return integer 
     */
    public function getMndInc()
    {
        return $this->mndInc;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Hero
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     * @return Hero
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return integer 
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set nextFight
     *
     * @param datetime $nextFight
     * @return Hero
     */
    public function setNextFight($nextFight)
    {
    	$this->nextFight = $nextFight;
    
    	return $this;
    }
    
    /**
     * Get nextFight
     *
     * @return datetime
     */
    public function getNextFight()
    {
    	return $this->nextFight;
    }
    
    /**
     * Set owner
     *
     * @param integer $owner
     * @return Hero
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return integer 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    //Experience required to level up increases by 100 at each level.
    const EXP_COEFF = 100;
    const HP_COEFF = 2;
    const ARMOR_COEFF = 0.1;
    const DMG_STR_COEFF = 1;
    const DMG_DEX_COEFF = 2;
    const DMG_MND_COEFF = 1.5;
    
    const SPEED_STR_COEFF = 1;
    const SPEED_DEX_COEFF = 1.2;
    const SPEED_MND_COEFF = 1.1;
    
    const HERO_TYPES = 3;
    private static $TYPES = array(
    		1 => array(
    				'str' => 5,
    				'dex' => 3,
    				'mnd' => 1,
    		),
    		2 => array(
    				'str' => 1,
    				'dex' => 5,
    				'mnd' => 3,
    		),
    		3 => array(
    				'str' => 3,
    				'dex' => 1,
    				'mnd' => 5,
    		),
    );
    
    public function setBaseStats()
    {
    	$type = $this->getType();
    	
	    $this->setStrInc(self::$TYPES[$type]['str']);
	    $this->setDexInc(self::$TYPES[$type]['dex']);
	    $this->setMndInc(self::$TYPES[$type]['mnd']);
	     
	    $this->setStr($this->getStrInc());
	    $this->setDex($this->getDexInc());
	    $this->setMnd($this->getMndInc());
	     
	    $this->setLevel(1);
	    $this->setExp(0);
	    
    }
    
    public function getMaxExp() 
    {
    	return floor($this->getLevel() * self::EXP_COEFF);	
    }
    
    public function getHP()
    {
    	return floor($this->getStr() * self::HP_COEFF);
    }
    public function getDamage()
    {
    	switch ($this->getType()) {
    		case 1: return floor($this->getStr() * self::DMG_STR_COEFF);
    		case 2: return floor($this->getDex() * self::DMG_DEX_COEFF);
    		case 3: return floor($this->getMnd() * self::DMG_MND_COEFF);
    	}
    }
    public function getArmor()
    {
    	return floor($this->getDex() * self::ARMOR_COEFF);
    }
    public function getSpeed()
    {
    	switch ($this->getType()) {
    		case 1: return floor($this->getDex() * self::SPEED_STR_COEFF);
    		case 2: return floor($this->getDex() * self::SPEED_DEX_COEFF);
    		case 3: return floor($this->getDex() * self::SPEED_MND_COEFF);
    	}
    }
    
    public function levelUp()
    {
    	if ($this->getExp() > $this->getMaxExp()) {
    		$this->setExp(0);
    		$this->setLevel($this->getLevel()+1);
    		
    		$this->setStr($this->getStr() + $this->getStrInc());
    		$this->setDex($this->getDex() + $this->getDexInc());
    		$this->setMnd($this->getMnd() + $this->getMndInc());
    	}
    }
    public function jumpToLevel($newLevel) {
    	$deltaLevel = $newLevel - $this->getLevel();
    	
    	$this->setExp(0);
    	$this->setLevel($newLevel);
    	$this->setStr($this->getStr() + $deltaLevel * $this->getStrInc());
    	$this->setDex($this->getDex() + $deltaLevel * $this->getDexInc());
    	$this->setMnd($this->getMnd() + $deltaLevel * $this->getMndInc());
    }
}
