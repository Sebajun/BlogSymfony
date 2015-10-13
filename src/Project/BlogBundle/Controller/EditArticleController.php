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
            ->add('content', 'textarea', array(
                'attr' => array(
                    'rows' => '25',
                    'cols' => '80',
                )
            ))
            ->add('created', 'date', array( 'disabled' => 'true'))
            ->add('save', 'submit', array('label' => 'Edit Article'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $article->setUpdated(new \DateTime("now"));
            $em->flush();
        }

        $form = $form->createView();

        return $this->render('BlogBundle:Article:edit_article.html.twig', array(
            'form'=>$form,
            'id'=>$id,
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('BlogBundle:Article')->find($id);

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('manage_article');
    }
}
