<?php

namespace Alloservice\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Alloservice\UserBundle\Entity\User;
use Alloservice\UserBundle\Form\ClientType;
use Alloservice\UserBundle\Form\JoberType;

class RegistrationController extends Controller
{
    /**
     * @Route("/inscription", name="alloservice_registration_register")
     */
    public function indexAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$user = new User();
		$form1 = $this->createForm(ClientType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_client')));
		$form2 = $this->createForm(JoberType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_jober')));
		
		
        return $this->render('@AlloserviceUser/Registration/index.html.twig', array('form1'=>$form1->createView(), 'form2'=>$form2->createView()));
	}
    
    /**
     * @Route("inscription/client", name="alloservice_registration_register_client")
     */
    public function clientAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$user = new User();
		$session = new Session();
		
        $form1 = $this->createForm(ClientType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_client')));
        $form2 = $this->createForm(JoberType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_jober')));
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()){
            $user->setSalt();
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setActived(true);
            $user->preUpdate();
			$user->setRegistrationDate(new \DateTime());
            $em->persist($user);
            $em->flush();	

            $session->getFlashBag()->add('success',"Félicitation ! Votre compte a bien été créé.");
            return $this->redirectToRoute('alloservice_site_homepage');
        }
        return $this->render('@AlloserviceUser/Registration/index.html.twig', array('form1'=>$form1->createView(), 'form2'=>$form2->createView()));
    }
    
    /**
     * @Route("inscription/jobeur", name="alloservice_registration_register_jober")
     */
    public function joberAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$user = new User();
		$session = new Session();
		
		$form1 = $this->createForm(ClientType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_client')));
        $form2 = $this->createForm(JoberType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_jober')));
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid())
		{
			$user->setSalt();
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setActived(false);
            $user->setRoles(['ROLE_JOBEUR']);
			$user->preUpdate();
			$user->setRegistrationDate(new \DateTime());
            $em->persist($user);
            $em->flush();

            $session->getFlashBag()->add('success',"Félicitation ! Votre compte a bien été créé.");
            return $this->redirectToRoute('alloservice_site_homepage');
		}
        return $this->render('@AlloserviceUser/Registration/index.html.twig', array('form1'=>$form1->createView(), 'form2'=>$form2->createView()));
    }
}
