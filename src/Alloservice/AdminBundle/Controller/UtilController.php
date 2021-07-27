<?php

namespace Alloservice\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alloservice\AdminBundle\Entity\Service;
use Alloservice\BlogBundle\Entity\Article;
use Alloservice\UserBundle\Entity\User;

class UtilController extends Controller
{
    public function utilAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(User::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Utilisateur supprimé.');
        }
        $query = $em->getRepository(User::class)->getAll('ADMIN');
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/Util/util.html.twig',[
            'tab' => $pagination,
        ]);
    }

    public function clientAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(User::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Client supprimé.');
        }
        $query = $em->getRepository(User::class)->getAll('CLIENT');
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/Util/client.html.twig',[
            'tab' => $pagination,
        ]);
    }

    public function jobeurAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $tab = $req->request->get('del');
        if (!is_null($tab) && !empty($tab)) {
            foreach ($tab as $id) {
                $entity = $em->getRepository(User::class)->find($id);
                if (!is_null($entity))
                    $em->remove($entity);
            }
            $em->flush();
            $this->addFlash('success','Jobeur supprimé.');
        }
        $query = $em->getRepository(User::class)->getAll('JOBEUR');
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            12
        );
        return $this->render('@AlloserviceAdmin/Util/jobeur.html.twig',[
            'tab' => $pagination,
        ]);
    }
}
