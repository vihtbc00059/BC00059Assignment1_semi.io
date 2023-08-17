<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Order;
use App\Form\InvoiceDetailFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class InvoiceDetailController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
        {
        }
    // #[Route('/invoice/detail', name: 'app_invoice_detail')]
    // public function index(): Response
    // {
    //     $invd = new OrderItem();
    //     $form = $this->createForm(InvoiceDetailFormType::class, $invd);
    //     $form->handleRequest($req);

    //     if($form->isSubmitted() && $form->isValid()) {
    //         $data = $form->getData();

    //         $em->persist($data);
    //         $em->flush();
        
    //     return new RedirectResponse($this->urlGenerator->generate('app_ds_Invoicedetail'));

    //     }

    //     return $this->render('invoice_detail/index.html.twig', [
    //         'invoicedetail_form' => $form->createView(),
    //     ]);
    // }

    #[Route('/invoicedetail/{id}', name: 'app_ds_Invoicedetail')]
    public function list_invd(EntityManagerInterface $em, int $id, Request $req): Response
    {
        $order = $em->find(Order::class, $id); 
        return $this->render('invoice_detail/list.html.twig', [
            "data"=>$order->getOrderItems()
        ]);

        
    }
}
     