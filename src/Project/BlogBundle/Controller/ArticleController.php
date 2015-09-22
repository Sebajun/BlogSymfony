<?php

namespace Project\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function pageAction($page)
    {
        $maxArticles = 5;
        $articlesCount = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->count();

        $pagination = array(
            'page' => $page,
            'route' => 'blog_page',
            'pages_count' => ceil($articlesCount / $maxArticles),
            'route_params' => array()
        );

        $articles = $this->getDoctrine()->getRepository('BlogBundle:Article')
            ->getList($page, $maxArticles);

        var_dump($articlesCount);

        return $this->render('::base.html.twig', array(
            'articles' => $articles,
            'pagination' => $pagination
        ));
    }

    public function articleAction($id)
    {
        //on cherche l'article avec l'id spécifié en argument
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BlogBundle:Article');

        $article = $repository->findOneById($id);

        //on redirige vers la page de l'article

        return $this->render('BlogBundle:Article:article.html.twig', array(
            'article' => $article,
        ));

    }
}