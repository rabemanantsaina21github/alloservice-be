<?php

namespace Alloservice\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alloservice\SiteBundle\Entity\Partner;
use Alloservice\SiteBundle\Form\PartnerType;

class PartnerController extends Controller
{
    public function partnerAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(Partner::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Partner suppressed.');
        }
        $query = $em->getRepository(Partner::class)->getAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/Partner/partner.html.twig',[
            'tab' => $pagination,
        ]);
    }

    public function partner_addAction(Request $req)
    {
        $partner = new Partner();
        $form = $this->createForm(PartnerType::class,$partner,['action' => $this->generateUrl('alloservice_admin_partner_add')]);
        $form->handleRequest($req);
        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();
            $this->addFlash('success','Partenaire mis en ligne.');
            return $this->redirectToRoute('alloservice_admin_partner');
        }
        return $this->render('@AlloserviceAdmin/Partner/partner_add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function partner_editAction(Partner $partner, Request $req)
    {
        $form = $this->createForm(PartnerType::class,$partner,['edit' => true,'action' => $this->generateUrl('alloservice_admin_partner_edit',['id' => $partner->getId()])]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();
            $this->addFlash('success','Partenaire mis à jour.');
            return $this->redirectToRoute('alloservice_admin_partner_edit',['id' => $partner->getId()]);
        }
        return $this->render('@AlloserviceAdmin/Partner/partner_add.html.twig',[
            'form' => $form->createView(),
            'entity' => $partner,
        ]);
    }
}
