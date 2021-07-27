<?php

namespace Alloservice\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use Alloservice\UserBundle\Entity\User;
use Alloservice\UserBundle\Form\ResettingType;
use Alloservice\UserBundle\Repository\UserRepository;

class ResettingController extends Controller
{
    /**
     * @Route("/mot-de-passe-oublie", name="alloservice_resetting_request")
     */
    public function requestAction()
    {
        return $this->render('@AlloserviceUser/Resetting/request.html.twig');
    }
    
    /**
     * @Route("/lien-de-recuperation-de-compte", name="alloservice_resetting_send_email")
     */
    public function sendEmailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $session = new Session();

        $email = $request->request->get('email');
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository('AlloserviceUserBundle:User')
            ->loadUserByEmail($email);
        if (null === $user) {
            return $this->render('@AlloserviceUser/Resetting/request.html.twig',
                array('email' => $email)
            );
        }

        $email = $user->getEmail();
        $password = $user->getPassword();
        $user->setPassword($password);
        $em->persist($user);
        $em->flush();

        // Envoyer un lien de récupération de mot de passe par email
        $url = $this->generateUrl('alloservice_resetting_reset', array('email' => $email));
        $message = \Swift_Message::newInstance()
            ->setSubject("Bonjour" . $user->getLastname() . " " . $user->getName() . " " . "!")
            ->setFrom('noreply@alloservice.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'email/resetting.html.twig',
                    array('lastname' => $user->getLastname(), 'name' => $user->getName(), 'url' => $url)
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        $email = $this->getObfuscatedEmail($user);

        $session->getFlashBag()->add('success', "We sent a link to recover the password in your address $email !");
        return $this->redirectToRoute('alloservice_site_homepage');
    }
    
    /**
     * @Route("/reinitialisation-de-mot-de-passe/{email}", name="alloservice_resetting_reset")
     */
    public function resetAction($email, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $session = new Session();

        $user = $em->getRepository('AlloserviceUserBundle:User')->loadUserByEmail($email);
        if (null === $user) {
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(ResettingType::class, $user, array('action' => $this->generateUrl('alloservice_resetting_reset', array('email' => $email))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setSalt();
            $password = $user->getPassword();
            $password = $this->get('security.password_encoder')->encodePassword($user, $password);
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();

            $session->getFlashBag()->add('success', "your password has been changed!");
            return $this->redirectToRoute('alloservice_site_homepage');
        }
        return $this->render('@AlloserviceUser/Resetting/reset.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @param \Alloservice\UserBundle\Entity\User $user
     *
     * @return string
     */
    protected function getObfuscatedEmail(User $user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }
        return $email;
    }

}
