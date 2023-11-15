<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Form\AddQuizzType;
use App\Form\AddQuestionType;
use App\Form\AddReponseType;
use Symfony\Component\OptionsResolver\OptionsResolver;



class AdminController extends AbstractController
{
    #[Route('/addQuizz', name: 'app_Quizz')]
    public function index(Request $request,EntityManagerInterface $entityManagerInterface,SluggerInterface $slugger): Response
    {

        $addQuizz = new Quiz();

        $form = $this->createForm(AddQuizzType::class, $addQuizz);
        $form->handleRequest($request);

          // début sauvegarde immage dans dossier "public/imageQuizz"
          if($request->isMethod('POST')){
            if ($form->isSubmitted() && $form->isValid()){
                $image = $form->get('image')->getData();
                
                // Générez un nom de fichier unique pour éviter les conflits de noms de fichiers
                $nomImage = uniqid().'.'.$image->guessExtension();
                // Enregistrez le nom du fichier dans l'entité
                $addQuizz->setFileName($image->getClientOriginalName());

                if($image){
                 $nomImage = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                 $nomImage = $slugger->slug($nomImage);
                 $nomImage = $nomImage.'.'.$image->guessExtension();
                    try{                 
                        $image->move($this->getParameter('file_directory_quizz'), $nomImage);
                        $this->addFlash('notice', 'Fichier envoyé');
                    }
                    catch(FileException $e){
                        $this->addFlash('notice', 'Erreur d\'envoi');
                    }        
                } 
                // fin sauvegarde immage dans dossier "public/imageQuizz"
                $entityManagerInterface->persist($addQuizz);
                $entityManagerInterface->flush();
                return $this->redirectToRoute('index'); 
                }
            }

        return $this->render('admin/addQuizz.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView()
        ]);
    }


    
    #[Route('/addQuestion', name: 'app_addQuizz')] // étape 1
    public function AjoutQuestion(Request $request,EntityManagerInterface $entityManagerInterface): Response // étape 2
    {
          $addQuestion = new Question();

      $form = $this->createForm(AddQuestionType::class, $addQuestion);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $entityManagerInterface->persist($addQuestion);
          $entityManagerInterface->flush();
            return $this->redirectToRoute('app_addQuizz'); 
        }

     


        
        return $this->render('admin/addQuestion.html.twig', [
            'form' => $form->createView(),
            
        ]);
        
    }

    #[Route('/addReponse', name: 'app_addReponse')] // étape 1
    public function AjoutReponse(Request $request,EntityManagerInterface $entityManagerInterface): Response // étape 2
    {
          $addReponse = new Reponse();

      $form = $this->createForm(AddReponseType::class, $addReponse);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $entityManagerInterface->persist($addReponse);
          $entityManagerInterface->flush();
            return $this->redirectToRoute('app_addReponse'); 
        }

     


        
        return $this->render('admin/addReponse.html.twig', [
            'form' => $form->createView(),
            
        ]);
        
    }
}
