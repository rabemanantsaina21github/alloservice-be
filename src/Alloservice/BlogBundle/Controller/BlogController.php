<?php

namespace Alloservice\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alloservice\BlogBundle\Entity\Article;
use Alloservice\BlogBundle\Entity\ArticleCategory;

class BlogController extends Controller
{
    public function indexAction(Request $req)
    {
    	$em = $this->getDoctrine()->getManager();
    	$article = $em->getRepository(Article::class)->getLastArticle();
    	$categories = $em->getRepository(ArticleCategory::class)->findAll();
        $articles = [];
        if (!is_null($article)){
            $query = $em->getRepository(Article::class)->getArticles($article->getId());
            $paginator  = $this->get('knp_paginator');
            $articles = $paginator->paginate(
                $query,
                $req->query->getInt('p', 1),
                10
            );
        }
            
        return $this->render('@AlloserviceBlog/Blog/index.html.twig',[
        	'article' => $article,
            'categories' => $categories,
            'articles' => $articles,
        ]);
    }

    public function by_categoryAction(ArticleCategory $category, Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(ArticleCategory::class)->findAll();
        
        $query = $em->getRepository(Article::class)->getArticlesByCategory($category);
        $paginator  = $this->get('knp_paginator');
        $articles = $paginator->paginate(
            $query,
            $req->query->getInt('p', 1),
            10
        );
        
        return $this->render('@AlloserviceBlog/Blog/by_category.html.twig', [
            'articles' => $articles,
        	'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function readAction($cat_slug, Article $article)
    {
        if($article->getCategory()->getSlug() != $cat_slug)
            throw $this->createNotFoundException();
        $em = $this->getDoctrine()->getManager();
        $lastArticles = $em->getRepository(Article::class)->getLastArticles($article->getId(),3);
        
        return $this->render('@AlloserviceBlog/Blog/read.html.twig', [
            'lastArticles' => $lastArticles,
            'article' => $article,
        ]);
    }
}
