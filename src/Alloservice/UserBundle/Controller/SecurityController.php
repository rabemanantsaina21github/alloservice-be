<?php

namespace Alloservice\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HTTPFoundation\Session\Session;
use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Alloservice\UserBundle\Entity\User;
use Alloservice\UserBundle\Form\ClientType;
use Alloservice\UserBundle\Form\JoberType;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="alloservice_security_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
		$error = $authenticationUtils->getLastAuthenticationError();
		$lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('@AlloserviceUser/Security/login.html.twig', array('last_username'=>$lastUsername, 'error'=>$error));
    }
	
	/**
	 * @Route("/profile/informations-personnelles", name="alloservice_security_profile_infoperso")
	 */
	public function infoPersoAction()
	{
		return $this->render('@AlloserviceUser/Security/infoPerso.html.twig');
	}
	
	/**
	 * @Route("/profile/informations-professionnelles", name="alloservice_security_profile_infopro")
	 */
	public function infoProAction()
	{
		return $this->render('@AlloserviceUser/Security/infoPro.html.twig');
	}
	
	/**
	 * @Route("/profile/confiance-et-securite", name="alloservice_security_profile_trustsecurity")
	 */
	public function trustAndsecurityAction()
	{
		return $this->render('@AlloserviceUser/Security/trustAndsecurity.html.twig');
	}
	
	/**
	 * @Route("/profile/statut-de-profil", name="alloservice_security_profile_status")
	 */
	public function statusAction()
	{
		return $this->render('@AlloserviceUser/Security/status.html.twig');
	}
	
	/**
	 * @Route("/jobeur/antonio-toulouse-619257", name="alloservice_security_profil")
	 */
	public function profileAction()
	{
		return $this->render('@AlloserviceUser/Security/profil.html.twig');
	}
	
	/**
	 * @Route("/compte/parametres-des-alertes", name="alloservice_security_parameters")
	 */
	public function parametresAction()
	{
		return $this->render('@AlloserviceUser/Security/parametres.html.twig');
	}
	
	/**
	 * @Route("/compte/facture", name="alloservice_security_parameters_facture")
	 */
	public function factureAction()
	{
		return $this->render('@AlloserviceUser/Security/paiements.html.twig');
	}
	
	/**
	 * @Route("/compte/mot-de-passe", name="alloservice_security_parameters_password")
	 */
	public function passwordAction()
	{
		return $this->render('@AlloserviceUser/Security/password.html.twig');
	}
	
	/**
	 * @Route("/compte/supprimez", name="alloservice_security_parameters_delete")
	 */
	public function supprimezCompteAction()
	{
		return $this->render('@AlloserviceUser/Security/deleteAccount.html.twig');
	}
    
    /**
     * @Route("/login_check", name="alloservice_security_login_check")
     */
    public function checkAction()
    {
        throw new \RuntimeException('Vous devez configurer le "check path" manuelement dans votre "security firewall configuration".');
    }
    
    /**
     * @Route("/deconnexion", name="alloservice_security_logout")
     */
    public function logoutAction()
    {
        throw new \RuntimeException('Vous devez activer le "logout" dans votre "security firewall configuration".');
    }

}
