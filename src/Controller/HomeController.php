<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home/product', name: 'app_home_product')]
    public function product(): Response
    {
        return $this->render('home/product.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home/product/detail', name: 'app_home_product_detail')]
    public function detail(): Response
    {
        return $this->render('home/productDetail.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}