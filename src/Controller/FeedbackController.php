<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class FeedbackController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
        {
        }
    // #[Route('/feedback', name: 'app_feedback')]
    // public function index(EntityManagerInterface $em, Request $req): Response
    // {
    //     $fb = new Contact();
    //     $form = $this->createForm(ContactFormType::class, $fb);
    //     $form->handleRequest($req);

    //     if($form->isSubmitted() && $form->isValid()) {
    //         $data = $form->getData();

    //         $em->persist($data);
    //         $em->flush();
        
    //     return new RedirectResponse($this->urlGenerator->generate('app_ds_feedback'));

    //     }

    //     return $this->render('feedback/index.html.twig', [
    //         'feedback_form' => $form->createView(),
    //     ]);
    // }

    #[Route('/feedback/ds', name: 'app_ds_feedback')]
    public function list_fb(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('SELECT fb FROM App\Entity\Contact fb');
        $lSp = $query->getResult();
        return $this->render('feedback/list.html.twig', [
            "data"=>$lSp
        ]);
    }
    #[Route('/feedback/{id}/delete', name: 'app_delete_feedback')]
    public function delete(EntityManagerInterface $em, int $id,Request $req ): Response
    {
            $fb = $em->find(Contact::class, $id);
            $em->remove($fb);
            $em->flush();
            return new RedirectResponse($this->urlGenerator->generate('app_ds_feedback'));
    }  
}