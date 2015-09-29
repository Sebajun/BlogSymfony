<?php
/**
 * Created by PhpStorm.
 * User: Camille
 * Date: 29/09/2015
 * Time: 08:59
 */

namespace Project\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditArticleController extends Controller
{
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('BlogBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No news found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($article)
            ->add('title', 'text')
            ->add('author', 'text')
            ->add('content', 'textarea')
            ->add('updated', 'date')
            ->add('save', 'submit', array('label' => 'Edit Article'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
        }

        $form = $form->createView();

        return $this->render('BlogBundle:Article:edit_article.html.twig', array(
            'form'=>$form,
            'id'=>$id,
        ));
    }
}
