<?php

namespace brutal\IntBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use brutal\DbBundle\Entity\Hero;
use brutal\Logic\Fights;

class DefaultController extends Controller
{
	const HERO_ID = "hero_id";
	const HERO_TYPES = 3;
	
	public function indexAction()
    {
    	$user = $this->getUser();
    	$session = $this->getRequest()->getSession();
    	$heroId = $session->get(self::HERO_ID, 0);
    	
    	$data = array(
    			'name' => $user->getEmail(),
    			'hero_id' => $heroId
    	);
    	
    	if ($heroId > 0) {
    		
    		$hero = $this->getDoctrine()
    			->getRepository('brutalDbBundle:Hero')
    			->findOneById($heroId);
    		
    		$data['hero'] = $hero;
    		
    		$fight = new Fights();
    		$secs = $fight->CheckSecs($hero);
    		$data['secs'] = $secs;
    	}
    	    	
    	return $this->render('brutalIntBundle:Default:index.html.twig', $data);
    }
    
    /* enemy fight */
    public function fightAction($type) 
    {
    	//Define me
    	$session = $this->getRequest()->getSession();
    	$heroId = $session->get(self::HERO_ID, 0);
    	if ($heroId <= 0)
    		return $this->redirect($this->generateUrl('brutal_int_homepage'));
    	$hero = $this->getDoctrine()
	    	->getRepository('brutalDbBundle:Hero')
	    	->findOneById($heroId);
    	
    	//Define the enemy
    	$enemy = new Hero();
    	$enemy->setType($type);
    	$enemy->setBaseStats();
    	$enemy->jumpToLevel($hero->getLevel());
    	
    	//Fight
    	$fight = new Fights();
    	$result = $fight->fight($hero, $enemy);
    	
    	//Save stuff after the fight
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($hero);
    	$em->flush();
    	
    	$data = array(
    		'result' => $result 
    	);
    	
    	return $this->render('brutalIntBundle:Default:fight.html.twig', $data);
    }
    
    /* Hero Level up */
    public function hLevelUpAction()
    {
    	$session = $this->getRequest()->getSession();
    	$heroId = $session->get(self::HERO_ID, 0);
    	
    	if ($heroId > 0) {
    		$hero = $this->getDoctrine()
	    		->getRepository('brutalDbBundle:Hero')
	    		->findOneById($heroId);
    		
    		$hero->levelUp();
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($hero);
    		$em->flush();
    	}
    	return $this->redirect($this->generateUrl('brutal_int_homepage'));
    }
    
    /* Hero Selection */
    public function hListAction()
    {
    	$heroes = $this->getDoctrine()
    		->getRepository('brutalDbBundle:Hero')
    		->findBy(array('owner' => $this->getUser()));
    	
    	$data = array(
    		'heroes' => $heroes,
    	);
    	return $this->render('brutalIntBundle:Default:hero/list.html.twig', $data);
    }
    public function hListCheckAction($id) 
    {
    	$session = $this->getRequest()->getSession();
    	$session->set(self::HERO_ID, $id);
    	
    	return $this->redirect($this->generateUrl('brutal_int_homepage'));
    }
    
    
    /* Hero creation */
    public function hCreateAction()
    {
    	return $this->render('brutalIntBundle:Default:hero/create.html.twig');
    }
    public function hCreateCheckAction()
    {
    	$request = $this->getRequest();
    	
    	$name = $request->request->get("name", "");
    	$type = $request->request->get("type", 0);
    	
    	if ($name == "" || $type <= 0 || $type > self::HERO_TYPES) {
    		return $this->redirect($this->generateUrl('p_hero_create'));
    	}
    	
    	$hero = new Hero();
    	$hero->setName($name);
    	$hero->setType($type);
    	
    	$hero->setBaseStats();
    	    	
    	$hero->setOwner($this->getUser());
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($hero);
    	$em->flush();
    	
    	return $this->render('brutalIntBundle:Default:hero/createConfirm.html.twig');
    }
}
