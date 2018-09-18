<?php

namespace App\Controller;

use App\Entity\Report;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Annotation\Method;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ReportController extends AbstractController
{
    /**
     * @Route("/report", name="index")
     */
    public function index()
    {

        $arrPost =  $this->getDoctrine()->getRepository(Report::class)->findAll();

       
        return $this->render('report/index.html.twig', [
            'controller_name' => 'PostController',
            'name' => 'Bogdan',
            'posts' => $arrPost
        ]);
    
    }
    
    /**
     * @Route("/report/new",name="new", methods={"GET","POST"})
     */
    public function newPost(Request $request)
    {
        $report = new Report();
        $report->setUsername('bog');
        

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('content', TextareaType::class,array('attr' => array('class' => 'form-control')))
            ->add('createAt', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Create Post','attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

           $form->handleRequest($request);
          
            if($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();
                return $this->redirectToRoute('index');
            }

         return $this->render('post/new.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/report/save", name="save", methods={"GET"})
     * 
     */
    public function save()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $post = new Report();

        $post->setUsername("b2");

        $entityManager->persist($post);

        $entityManager->flush();
        return new Response("save".$post->getId());
    }
}
