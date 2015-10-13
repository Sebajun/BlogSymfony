<?php

namespace Project\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Project\BlogBundle\Entity\Article;

class CreateArticleController extends Controller
{
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', 'text')
            ->add('author', 'text')
            ->add('content', 'froala'
            )
            ->add('save', 'submit', array('label' => 'Create Article'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $article->setCreated(new \DateTime("now"));
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('blog_index');
        }

        $form = $form->createView();

        return $this->render('BlogBundle:Article:create_article.html.twig', array(
            'form'=>$form,
        ));
    }

}