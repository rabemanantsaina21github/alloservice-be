<?php

namespace Alloservice\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alloservice\AdminBundle\Entity\Section;
use Alloservice\AdminBundle\Form\SectionType;

class SectionController extends Controller
{
    public function sectionAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(Section::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Section supprimée.');
        }
        $query = $em->getRepository(Section::class)->getAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/Section/section.html.twig',[
            'sections' => $pagination,
        ]);
    }

    public function section_addAction(Request $req)
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class,$section,['action' => $this->generateUrl('alloservice_admin_section_add')]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();
            $this->addFlash('success','Section mise en ligne.');
            return $this->redirectToRoute('alloservice_admin_section');
        }
        return $this->render('@AlloserviceAdmin/Section/section_add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function section_editAction(Section $section, Request $req)
    {
        $form = $this->createForm(SectionType::class,$section,['edit' => true,'action' => $this->generateUrl('alloservice_admin_section_edit',['id' => $section->getId()])]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();
            $this->addFlash('success','Section mise à jour.');
            return $this->redirectToRoute('alloservice_admin_section_edit',['id' => $section->getId()]);
        }
        return $this->render('@AlloserviceAdmin/Section/section_add.html.twig',[
            'form' => $form->createView(),
            'edit' => true,
        ]);
    }
}
