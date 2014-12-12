<?php

namespace brutal\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

use brutal\DbBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$user = $this->getUser();
    	if ($user == null) $name = "Teo";
    	else $name = $user->getEmail();
        return $this->render('brutalPublicBundle:Default:index.html.twig', array('name' => $name));
    }
    public function loginAction()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	
    	// get the login error if there is one
    	if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
    		$error = $request->attributes->get(
    				Security::AUTHENTICATION_ERROR
    		);
    	} elseif (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
    		$error = $session->get(Security::AUTHENTICATION_ERROR);
    		$session->remove(Security::AUTHENTICATION_ERROR);
    	} else {
    		$error = '';
    	}
    	
    	// last username entered by the user
    	$lastUsername = (null === $session) ? '' : $session->get(Security::LAST_USERNAME);
    	
    	return $this->render(
    			'brutalPublicBundle:Default:login.html.twig',
    			array(
    					'last_username' => $lastUsername,
    					'error'         => $error,
    			)
    	);
    	
    	return $this->render('brutalPublicBundle:Default:login.html.twig');
    }
    public function signupAction() 
    {
    	return $this->render('brutalPublicBundle:Default:signup.html.twig');
    }
    public function signupCheckAction() 
    {
    	$request = $this->getRequest();
    	$email = $request->request->get("_username");
    	$pass = $request->request->get("_password");
    	
    	$user = new User();
    	$user->setEmail($email);
    	$user->setPass(password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12)));
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($user);
    	$em->flush();
    	
    	return $this->loginAction();
    }
}
