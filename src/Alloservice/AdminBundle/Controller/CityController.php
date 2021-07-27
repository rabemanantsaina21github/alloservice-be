<?php

namespace Alloservice\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alloservice\SiteBundle\Entity\Country;
use Alloservice\SiteBundle\Entity\City;
use Alloservice\SiteBundle\Form\MyCountryType;
use Alloservice\SiteBundle\Form\CityType;

class CityController extends Controller
{
    public function city_countryAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(Country::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Pays supprimé.');
        }
        $country = new Country();
        $form = $this->createForm(MyCountryType::class,$country,['action' => $this->generateUrl('alloservice_admin_city_country')]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($country);
            $em->flush();
            $this->addFlash('success','Pays mis en ligne.');
            return $this->redirectToRoute('alloservice_admin_city_country');
        }
        $query = $em->getRepository(Country::class)->getAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/City/city_country.html.twig',[
            'tab' => $pagination,
            'form' => $form->createView(),
        ]);
    }

    public function city_country_editAction(Country $country, Request $req)
    {
        $form = $this->createForm(MyCountryType::class,$country,['edit' => true,'action' => $this->generateUrl('alloservice_admin_city_country_edit',['id' => $country->getId()])]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();
            $this->addFlash('success','Pays mis à jour.');
            return $this->redirectToRoute('alloservice_admin_city_country_edit',['id' => $country->getId()]);
        }
        return $this->render('@AlloserviceAdmin/City/city_country_edit.html.twig',[
            'form' => $form->createView(),
            'entity' => $country,
            'edit' => true,
        ]);
    }

    public function cityAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(City::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Ville supprimée.');
        }
        $query = $em->getRepository(City::class)->getAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/City/city.html.twig',[
            'tab' => $pagination,
        ]);
    }

    public function city_addAction(Request $req)
    {
        $city = new City();
        $form = $this->createForm(CityType::class,$city,['action' => $this->generateUrl('alloservice_admin_city_add')]);
        $form->handleRequest($req);
        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();
            $this->addFlash('success','Ville mise en ligne.');
            return $this->redirectToRoute('alloservice_admin_city');
        }
        return $this->render('@AlloserviceAdmin/City/city_add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function city_editAction(City $city, Request $req)
    {
        $form = $this->createForm(CityType::class,$city,['edit' => true,'action' => $this->generateUrl('alloservice_admin_city_edit',['id' => $city->getId()])]);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();
            $this->addFlash('success','Pays mis à jour.');
            return $this->redirectToRoute('alloservice_admin_city_edit',['id' => $city->getId()]);
        }
        return $this->render('@AlloserviceAdmin/City/city_add.html.twig',[
            'form' => $form->createView(),
            'entity' => $city,
            'edit' => true,
        ]);
    }
}
