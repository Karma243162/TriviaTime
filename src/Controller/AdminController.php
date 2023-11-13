<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Quiz;
use App\Form\AddQuizzType;


class AdminController extends AbstractController
{
    #[Route('/addQuizz', name: 'app_Quizz')]
    public function index(Request $request,EntityManagerInterface $entityManagerInterface): Response
    {

        $addQuizz = new Quiz();

        $form = $this->createForm(AddQuizzType::class, $addQuizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($addQuizz);
            $entityManagerInterface->flush();
              return $this->redirectToRoute('index'); 
          }

        return $this->render('admin/addQuizz.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView()
        ]);
    }
}
