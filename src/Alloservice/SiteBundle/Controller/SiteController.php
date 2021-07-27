<?php

namespace Alloservice\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Alloservice\AdminBundle\Entity\Service;
use Alloservice\BlogBundle\Entity\Article;
use Alloservice\AdminBundle\Entity\Section;
use Alloservice\UserBundle\Entity\User;
use Alloservice\SiteBundle\Entity\Contact;
use Alloservice\SiteBundle\Entity\Partner;
use Alloservice\UserBundle\Form\ClientType;
use Alloservice\UserBundle\Form\JoberType;
use Alloservice\SiteBundle\Form\ContactType;
use Alloservice\SiteBundle\Form\PatnerType;
use Alloservice\SiteBundle\Entity\City;

class SiteController extends Controller
{
    /**
     * @Route("/", name="alloservice_site_homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Service::class)->getCategories('ASC')->getResult();
        $lastArticles = $em->getRepository(Article::class)->findBy(['state' => true],['date' => 'DESC'],3,0);
        $section1 = $em->getRepository(Section::class)->find(1);
        $section2 = $em->getRepository(Section::class)->find(2);
        $section3 = $em->getRepository(Section::class)->find(3);
        $section4 = $em->getRepository(Section::class)->find(4);
        $section5 = $em->getRepository(Section::class)->find(5);
        $section6 = $em->getRepository(Section::class)->find(6);
        $section7 = $em->getRepository(Section::class)->find(7);
        $section8 = $em->getRepository(Section::class)->find(8);
        $section9 = $em->getRepository(Section::class)->find(9);
        $section10 = $em->getRepository(Section::class)->find(10);
        $partner1 = $em->getRepository(Partner::class)->find(1);
        $partner2 = $em->getRepository(Partner::class)->find(2);
        $partner3 = $em->getRepository(Partner::class)->find(3);
        $partner4 = $em->getRepository(Partner::class)->find(4);
        $partner5 = $em->getRepository(Partner::class)->find(5);
        return $this->render('@AlloserviceSite/Body/index.html.twig',[
            'categories' => $categories,
            'lastArticles' => $lastArticles,
            'section1' => $section1,
            'section2' => $section2,
            'section3' => $section3,
            'section4' => $section4,
            'section5' => $section5,
            'section6' => $section6,
            'section7' => $section7,
            'section8' => $section8,
            'section9' => $section9,
            'section10' => $section10,
            'partner1' => $partner1,
            'partner2' => $partner2,
            'partner3' => $partner3,
            'partner4' => $partner4,
            'partner5' => $partner5,
            'partner5' => $partner5,
        ]);
    }
    
    /**
     * @Route("/tableau-de-bord", name="alloservice_site_tableau_de_bord")
     */
    public function tableaudebordAction()
    {
        return $this->render('@AlloserviceSite/Body/tableau.html.twig');
    }
    
    // dodson 20190701

    /**
     * @Route("/services", name="alloservice_site_service_list")
     */
    public function service_listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Service::class)->getCategories('ASC')->getResult();
        $lastArticles = $em->getRepository(Article::class)->findBy(['state' => true],['date' => 'DESC'],3,0);
        $section4 = $em->getRepository(Section::class)->find(4);
        $section6 = $em->getRepository(Section::class)->find(6);
        $section11 = $em->getRepository(Section::class)->find(11);
        return $this->render('@AlloserviceSite/Body/Service/service_list.html.twig',[
            'categories' => $categories,
            'lastArticles' => $lastArticles,
            'section4' => $section4,
            'section6' => $section6,
            'section11' => $section11,
        ]);
    }

    /**
     * @Route("/services/{slug}", name="alloservice_site_service")
     */
    public function serviceAction(Service $service)
    {
        $em = $this->getDoctrine()->getManager();
        $lastArticles = $em->getRepository(Article::class)->findBy(['state' => true],['date' => 'DESC'],3,0);
        $section4 = $em->getRepository(Section::class)->find(4);
        $section6 = $em->getRepository(Section::class)->find(6);
	$cities = $em->getRepository(City::class)->getTop(8);
        
        return $this->render('@AlloserviceSite/Body/Service/service.html.twig',[
            'service' => $service,
            'lastArticles' => $lastArticles,
            'section4' => $section4,
            'section6' => $section6,
            'cities' => $cities,
        ]);
    }
    
    /**
     * @Route("/services/{s_slug}/{slug}", name="alloservice_site_sousservice")
     */
    public function sousServiceAction($s_slug,Service $service)
    {
        if ((!is_null($service->getService()) && $s_slug != $service->getService()->getSlug()) OR (!is_null($service->getSupService()) && $s_slug != $service->getSupService()->getSlug()))
            throw $this->createNotFoundException();
        $em = $this->getDoctrine()->getManager();
        $lastArticles = $em->getRepository(Article::class)->findBy(['state' => true],['date' => 'DESC'],3,0);
        $section4 = $em->getRepository(Section::class)->find(4);
        $section6 = $em->getRepository(Section::class)->find(6);
	$cities = $em->getRepository(City::class)->getTop(8);
        
        return $this->render('@AlloserviceSite/Body/Service/sous-service.html.twig',[
            'service' => $service,
            'lastArticles' => $lastArticles,
            'section4' => $section4,
            'section6' => $section6,
            'cities' => $cities,
        ]);
    }

    /**
     * @Route("/services/{s_slug1}/{s_slug2}/{slug}", name="alloservice_site_sousservice2")
     */
    public function sousService2Action($s_slug1,$s_slug2,Service $service)
    {
        if ($s_slug2 != $service->getSupService()->getSlug() OR $s_slug1 != $service->getSupService()->getService()->getSlug())
            throw $this->createNotFoundException();

        $em = $this->getDOctrine()->getManager();
        $cities = $em->getRepository(City::class)->getTop(8);
        $section4 = $em->getRepository(Section::class)->find(4);
        $section6 = $em->getRepository(Section::class)->find(6);
        return $this->render('@AlloserviceSite/Body/Service/sous-service.html.twig',[
            'service' => $service,
            'cities' => $cities,
            'section4' => $section4,
            'section6' => $section6,
        ]);
    }


    /**
     * @Route("/poster-un-job/{id}", name="alloservice_site_create_job")
     * @author dodson 20190709
     */
    public function createJobAction(Service $service)
    {
        return $this->render('@AlloserviceSite/Body/Service/poster-un-job.html.twig',[
            'service' => $service,
        ]);
    }
    
    /**
     * @Route("/parainage", name="alloservice_site_parainage")
     */
    public function parainageAction(Request $request)
    {
        return $this->render('@AlloserviceSite/Footer/parainage.html.twig');
    }
    
    /**
     * @Route("/annonces", name="alloservice_site_trouver_un_job")
     */
    public function trouverAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Service::class)->getCategories('ASC')->getResult();
        return $this->render('@AlloserviceSite/Footer/trouverunjob.html.twig',[
            'categories' => $categories,
            ]);
    }
    
    /**
     * @Route("/annonces/{slug}", name="alloservice_site_annonces_services")
     */
    public function servicesAnnoncesAction(Service $service)
    {
        return $this->render('@AlloserviceSite/Footer/Annonces/annoncesdeservices.html.twig',[
            'service' => $service,
            ]);
    }
    
    /**
     * @Route("/annonces/{s_slug}/{slug}", name="alloservice_site_annonces_sousservices")
     */
    public function sousservicesAnnoncesAction($s_slug, Service $service)
    {
        if ((!is_null($service->getService()) && $s_slug != $service->getService()->getSlug()) OR (!is_null($service->getSupService()) && $s_slug != $service->getSupService()->getSlug()))
            throw $this->createNotFoundException();
        
        return $this->render('@AlloserviceSite/Footer/Annonces/annoncessousservices.html.twig',[
            'service' => $service,
            ]);
    }
    
    /**
     * @Route("/jobs_search", name="alloservice_site_joblist")
     */
    public function joblistAction()
    {
        return $this->render('@AlloserviceSite/Body/joblist.html.twig');
    }
    
    /**
     * @Route("/notifications", name="alloservice_site_notifications")
     */
    public function notificationsAction()
    {
        return $this->render('@AlloserviceSite/Head/notifications.html.twig');
    }
    
    /**
     * @Route("/messages", name="alloservice_site_messages")
     */
    public function messagesAction()
    {
        return $this->render('@AlloserviceSite/Head/messages.html.twig');
    }
    
    /**
     * @Route("/paiements-finals/nouveau", name="alloservice_site_payouts_new")
     */
    public function comptePaiementAction()
    {
        return $this->render('@AlloserviceSite/Head/comptePaiement.html.twig');
    }
    
    /**
     * @Route("/devenez-jobeur/step_1", name="alloservice_site_step1")
     */
    public function step1Action()
    {
        return $this->render('@AlloserviceSite/Body/Competences/step1.html.twig');
    }
    
    /**
     * @Route("/devenez-jobeur/step_2", name="alloservice_site_step2")
     */
    public function step2Action()
    {
        return $this->render('@AlloserviceSite/Body/Competences/step2.html.twig');
    }
    
    /**
     * @Route("/devenez-jobeur/step_3", name="alloservice_site_step3")
     */
    public function step3Action()
    {
        return $this->render('@AlloserviceSite/Body/Competences/step3.html.twig');
    }
    
    /**
     * @Route("/devenez-jobeur/step_4", name="alloservice_site_step4")
     */
    public function step4Action()
    {
        return $this->render('@AlloserviceSite/Body/Competences/step4.html.twig');
    }
    
    /**
     * @Route("/devenir-jobeur", name="alloservice_site_devenir-jobeur")
     */
    public function devenirAction()
    {
		$em = $this->getDoctrine()->getManager();
		$user = new User();
		$form2 = $this->createForm(JoberType::class,$user,array('action'=>$this->generateUrl('alloservice_registration_register_jober')));
		
        return $this->render('@AlloserviceSite/Footer/devenir.html.twig', array('form2'=>$form2->createView()));
    }
    
    /**
     * @Route("/application-mobile-alloservice", name="alloservice_site_application_mobile")
     */
    public function applicationAction()
    {
        return $this->render('@AlloserviceSite/Footer/applicationmobile.html.twig');
    }
    
    /**
     * @Route("/avis-clients", name="alloservice_site_avis_clients")
     */
    public function avisAction()
    {
        return $this->render('@AlloserviceSite/Footer/avisclients.html.twig');
    }
    
    /**
     * @Route("/cartes-cadeaux", name="alloservice_site_cartescadeaux")
     */
    public function cartesAction()
    {
        return $this->render('@AlloserviceSite/Footer/cartescadeaux.html.twig');
    }
    
    /**
     * @Route("/cartes-cadeaux/nouveau", name="alloservice_site_cartescadeaux_new")
     */
    public function nouveauCartesAction()
    {
        return $this->render('@AlloserviceSite/Head/cartescadeaux-1.html.twig');
    }
    
    /**
     * @Route("/cartes-cadeaux/ajoutez", name="alloservice_site_cartescadeaux_add")
     */
    public function ajoutezCartesAction()
    {
        return $this->render('@AlloserviceSite/Head/cartescadeaux-2.html.twig');
    }
    
    /**
     * @Route("/cartes-cadeaux/hiqtorique", name="alloservice_site_cartescadeaux_historic")
     */
    public function historicCartesAction()
    {
        return $this->render('@AlloserviceSite/Head/cartescadeaux-3.html.twig');
    }
    
    /**
     * @Route("/qui-sommes-nous", name="alloservice_site_qui_sommes_nous")
     */
    public function quisommesnousAction()
    {
        return $this->render('@AlloserviceSite/Footer/quisommesnous.html.twig');
    }
    
    #INFORMATIONS UTILES
    
    /**
     * @Route("/centre-d-aide", name="alloservice_site_centre_d_aide")
     */
    public function aidesAction()
    {
        return $this->render('@AlloserviceSite/Footer/centredaide.html.twig');
    }
    
    /**
     * @Route("/l-assurance-alloservice", name="alloservice_site_l_assurance")
     */
    public function assuranceAction()
    {
        return $this->render('@AlloserviceSite/Footer/assurance.html.twig');
    }
    
    /**
     * @Route("/credit-d-impot", name="alloservice_site_credit_d_impot")
     */
    public function creditdimpotAction()
    {
        return $this->render('@AlloserviceSite/Footer/creditdimpot.html.twig');
    }
    
    /**
     * @Route("/conseils-jobbing", name="alloservice_site_conseils_jobbing")
     */
    public function conseilsjobbingAction()
    {
        return $this->render('@AlloserviceSite/Footer/conseilsjobbing.html.twig');
    }
    
    /**
     * @Route("/confiance-et-securite", name="alloservice_site_confiance_et_securite")
     */
    public function confianceEtsecuriteAction()
    {
        return $this->render('@AlloserviceSite/Footer/confianceetsecurite.html.twig');
    }
    
    /**
     * @Route("/qu-est-qu-un-jobeur-pro", name="alloservice_site_devenir_jobeur_pro")
     */
    public function jobeurproAction()
    {
        return $this->render('@AlloserviceSite/Footer/jobeurpro.html.twig');
    }
    
    /**
     * @Route("/presse", name="alloservice_site_presse")
     */
    public function presseAction()
    {
        return $this->render('@AlloserviceSite/Footer/presse.html.twig');
    }
    
    /**
     * @Route("/cgu", name="alloservice_site_cgu")
     */
    public function cguAction()
    {
        return $this->render('@AlloserviceSite/Footer/cgu.html.twig');
    }
    
    /**
     * @Route("/cgv", name="alloservice_site_cgv")
     */
    public function cgvAction()
    {
        return $this->render('@AlloserviceSite/Footer/cgv.html.twig');
    }
    
    /**
     * @Route("/tous-les-services-de-l-alloservice", name="alloservice_site_tous_les_services")
     */
    public function tousservicesAction()
    {
        return $this->render('@AlloserviceSite/Footer/touslesservices.html.twig');
    }
    
    /**
     * @Route("/toutes-les-villes-de-l-alloservice", name="alloservice_site_toutes_les_villes")
     */
    public function toutesvillesAction()
    {
        return $this->render('@AlloserviceSite/Footer/touteslesvilles.html.twig');
    }
    
    /**
     * @Route("/tous-les-jobeurs-de-l-alloservice", name="alloservice_site_toutes_les_jobeurs")
     */
    public function tousjobeursAction()
    {
        return $this->render('@AlloserviceSite/Footer/touteslesjobeurs.html.twig');
    }
    
    //ANTONIO A AJOUTE CET ACTION CI-DESSOUS
    
    /**
     * @Route("/centre-d-aide/nous-contacter", name="alloservice_site_contact")
     */
    public function contactAction(Request $request)
    {
        $session = new Session();
        $contact = new Contact();        
        $form = $this->createForm(ContactType::class,$contact,['action'=>$this->generateUrl('alloservice_site_contact')]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setFrom($contact->getEmail())
                ->setTo('noreply@alloservice.com')
                ->setBody(
                    $this->renderView(
                            'email/contact.html.twig',['email'=>$contact->getEmail(), 'description'=>$contact->getDescription(), 'categories'=>$contact->getCategories()]
                            ),
                        'text/html'
                    );
            //$attachement = (Swift_Attachement::newInstance($pdf, '$filename', 'application/pdf'));
            //$message->attach($attachement);
            $this->get('mailer')->send($message);
            $email = $this->getObfuscatedEmail($contact);
            
            $session->getFlashBag()->add('success', "Votre demande a été envoyée.");
            return $this->redirectToRoute('alloservice_site_centre_d_aide');
        }
    
        return $this->render('@AlloserviceSite/Footer/Aide/contact.html.twig', ['form'=>$form->createView()]);
    }
    
    /**
     * @Route("/centre-d-aide/client", name="alloservice_site_client")
     */
    public function clientAction(Request $request)
    {   
        return $this->render('@AlloserviceSite/Footer/Aide/client.html.twig');
    }
    
    /**
     * @Route("/centre-d-aide/jobeur", name="alloservice_site_jobeur")
     */
    public function jobeurAction(Request $request)
    {   
        return $this->render('@AlloserviceSite/Footer/Aide/jobeur.html.twig');
    }
    
    /**
     * @Route("/centre-d-aide/assurance", name="alloservice_site_aide_assurance")
     */
    public function assuranceAideAction(Request $request)
    {   
        return $this->render('@AlloserviceSite/Footer/Aide/assurance.html.twig');
    }
    

    /**
     * @author dodson 20190712
     */
    public function cityTop4Action()
    {   
        $em = $this->getDoctrine()->getManager();
        $cities = $em->getRepository(City::class)->getTop(4);
        return $this->render('@AlloserviceSite/Footer/cityTop4.html.twig',[
            'cities' => $cities,
        ]);
    }

    /**
     * @author dodson 20190712
     */
    public function serviceTop4Action()
    {   
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository(Service::class)->getTop(4);
        return $this->render('@AlloserviceSite/Footer/serviceTop4.html.twig',[
            'services' => $services,
        ]);
    }

    /**
    /* @param \Alloservice\SiteBundle\Entity\Contact $contact
    /*
    /* @return string
    */
   protected function getObfuscatedEmail(Contact $contact)
    {
        $email = $contact->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }
        return $email;
    }
    
}
