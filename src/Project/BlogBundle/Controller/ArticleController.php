<?php

namespace Project\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function pageAction($name)
    {

        //on récupère tous les 5 derniers articles

        //on redirige vers la page d'accueil
        return $this->render('BlogBundle:Default:index.html.twig', array('name' => $name));
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