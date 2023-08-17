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
        return $this->render('home/index.html.twig',[
        ]);
    }
    #[Route('/home/product', name: 'app_home_product')]
    public function product(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('SELECT sp FROM App\Entity\SanPham sp');  
        $lSp = $query->getResult();  
        return $this->render('home/product.html.twig', [
            "data"=>$lSp
        ]);
    }
   
    #[Route('/home/product/details/{id}', name: 'app_home_product_detail')]
        public function show(EntityManagerInterface $em, int $id): Response
        {
            $sp = $em->find(Sanpham::class, $id);

            return $this->render('home/productDetail.html.twig', [
                "data" => $sp
            ]);
        }

        #[Route('/home/product/shirt', name: 'app_home_product_shrirt')]
        public function shirt(EntityManagerInterface $em): Response
        {
            return $this->render('home/product.shirt.html.twig',[
            ]);
        }
        #[Route('/search', name: 'search_products')]
    public function search(Request $request): Response
    {
        $keyword = $request->query->get('keyword');

        $products = $this->entityManager->getRepository(SanPham::class)->findByKeyword($keyword);

        return $this->render('home/product.html.twig', ['data' => $products]);
    }
    #[Route('/home/intro', name: 'app_home_intro')]
    public function intro(EntityManagerInterface $em): Response
    {
        return $this->render('home/intro.html.twig',[
        ]);
    }
}