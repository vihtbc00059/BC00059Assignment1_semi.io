<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SanPhamType;
use App\Entity\SanPham;
use App\Entity\Category;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }
    #[Route('/home', name: 'app_home')]
    public function list_sp(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('SELECT sp FROM App\Entity\SanPham sp');  
        $lSp = $query->getResult();  
        return $this->render('home/index.html.twig',[
            "data"=>$lSp
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