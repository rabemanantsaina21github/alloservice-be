<?php

namespace Alloservice\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alloservice\AdminBundle\Entity\Service;
use Alloservice\BlogBundle\Entity\Article;
use Alloservice\BlogBundle\Entity\ArticleCategory;
use Alloservice\AdminBundle\Form\ServiceType;
use Alloservice\BlogBundle\Form\ArticleType;
use Alloservice\BlogBundle\Form\ArticleCategoryType;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('@AlloserviceAdmin/Main/index.html.twig');
    }

    /*******************\
    * SERVICES
    \*******************/

    // service list
    public function serviceAction($niv, Request $req)
    {
    	$em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(Service::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Service supprimé.');
        }
    	$query = $em->getRepository(Service::class)->getAll($niv);
	    $paginator  = $this->get('knp_paginator');
	    $pagination = $paginator->paginate(
	        $query,
	        $req->query->getInt('p', 1),
	        12
	    );
        return $this->render('@AlloserviceAdmin/Main/service.html.twig',[
        	'tab' => $pagination,
            'niv'=>$niv,
            'del' => $tab,
        ]);
    }

    // add service
    public function service_addAction($niv, Request $req)
    {
    	$service = new Service();
    	$form = $this->createForm(ServiceType::class,$service,array('niv'=>$niv,'action'=>$this->generateUrl('alloservice_admin_service_add',['niv' => $niv])));
    	$form->handleRequest($req);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($service);
    		$em->flush();
    		$this->addFlash('success',"Service mis en ligne.");
    		return $this->redirectToRoute('alloservice_admin_service',['niv' => $niv]);
    	}
        return $this->render('@AlloserviceAdmin/Main/service_add.html.twig',[
        	'form' => $form->createView(),
            'niv' => $niv,
        ]);
    }

    public function service_editAction($niv, Service $service, Request $req)
    {
    	$form = $this->createForm(ServiceType::class,$service,array('niv'=>$niv,'edit'=>true, 'action'=>$this->generateUrl('alloservice_admin_service_edit',['niv' => $niv,'id' => $service->getId()])));
    	$form->handleRequest($req);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($service);
    		$em->flush();
    		$this->addFlash('success',"Service mis à jour.");
    		return $this->redirectToRoute('alloservice_admin_service_edit',['niv' => $niv,'id' => $service->getId()]);
    	}
        return $this->render('@AlloserviceAdmin/Main/service_add.html.twig',[
        	'form' => $form->createView(),
        	'edit' => true,
        	'entity' => $service,
            'niv' => $niv,
        ]);
    }

    /*******************\
    * ARtICLES
    \*******************/

    // article list
    public function articleAction(Request $req)
    {
    	$em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(Article::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Article supprimé.');
        }
    	$query = $em->getRepository(Article::class)->getAll();
	    $paginator  = $this->get('knp_paginator');
	    $pagination = $paginator->paginate(
	        $query,
	        $req->query->getInt('p', 1),
	        12
	    );
        return $this->render('@AlloserviceAdmin/Main/article.html.twig',[
        	'tab' => $pagination,
        ]);
    }

    // article add
    public function article_addAction(Request $req)
    {
    	$article = new Article();
    	$form = $this->createForm(ArticleType::class,$article,['action'=>$this->generateUrl('alloservice_admin_article_add')]);
        $form->handleRequest($req);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
            $article->setDate(new \DateTime());
    		$em->persist($article);
    		$em->flush();
    		$this->addFlash('success',"Article mis en ligne.");
    		return $this->redirectToRoute('alloservice_admin_article');
    	}
    	return $this->render('@AlloserviceAdmin/Main/article_add.html.twig',[
        	'form' => $form->createView(),
        ]);
    }

    // article edit
    public function article_editAction(Article $article, Request $req)
    {
        $form = $this->createForm(ArticleType::class,$article,['edit' => true, 'action'=>$this->generateUrl('alloservice_admin_article_edit',['id'=>$article->getId()])]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            $this->addFlash('success',"Article mis à jour.");
            return $this->redirectToRoute('alloservice_admin_article_edit',['id'=>$article->getId()]);
        }
        return $this->render('@AlloserviceAdmin/Main/article_add.html.twig',[
            'form' => $form->createView(),
            'edit' => true,
            'entity' => $article,
        ]);
    }

    // article category list
    public function article_categoryAction(Request $req)
    {
    	$em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(ArticleCategory::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Catégorie supprimée.');
        }
    	$query = $em->getRepository(ArticleCategory::class)->getAll();
	    $paginator  = $this->get('knp_paginator');
	    $pagination = $paginator->paginate(
	        $query,
	        $req->query->getInt('p', 1),
	        12
	    );
	    $category = new ArticleCategory();
	    $form = $this->createForm(ArticleCategoryType::class,$category,['action' => $this->generateUrl('alloservice_admin_article_category')]);
	    $form->handleRequest($req);
	    if ($form->isSubmitted() && $form->isValid()) {
	    	$em->persist($category);
	    	$em->flush();
	    	$this->addFlash('success','Catégorie mise en ligne.');
	    	return $this->redirectToRoute('alloservice_admin_article_category');
	    }
        return $this->render('@AlloserviceAdmin/Main/article_category.html.twig',[
        	'tab' => $pagination,
        	'form' => $form->createView(),
        ]);
    }

    // article category edit
    public function article_category_editAction(ArticleCategory $category, Request $req)
    {
	    $form = $this->createForm(ArticleCategoryType::class,$category,['edit'=>true,'action' => $this->generateUrl('alloservice_admin_article_category_edit',['id' => $category->getId()])]);
	    $form->handleRequest($req);
	    if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
	    	$em->persist($category);
	    	$em->flush();
	    	$this->addFlash('success','Catégorie mise à jour.');
	    	return $this->redirectToRoute('alloservice_admin_article_category_edit',['id' => $category->getId()]);
	    }
        return $this->render('@AlloserviceAdmin/Main/article_category_edit.html.twig',[
        	'form' => $form->createView(),
        ]);
    }
}
