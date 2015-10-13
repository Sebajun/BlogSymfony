<?php

namespace Project\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageArticleController extends Controller
{
    public function manageAction()
    {
        //on récupère tous les articles

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository("BlogBundle:Article");

        $articles = $repository->findAll();

        //on renvoie la liste de tous les articles à la vue
        return $this->render("BlogBundle:Article:manage_article.html.twig", array(
            'articles' => $articles,
        ));
    }


}