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

class SanPhamController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }
    #[Route('/san/pham', name: 'app_san_pham')]
    public function index(EntityManagerInterface $em, Request $req, FileUploader $fileUploader): Response
    {
        $sp = new SanPham();
        $form = $this->createForm(SanPhamType::class, $sp);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $file = $form->get("photo")->getData();
            $fileName = $fileUploader->upload($file);
            $data->setPhoto($fileName);
            $em->persist($data);
            $em->flush();
            return new RedirectResponse($this->urlGenerator->generate('app_list_san_pham'));
            // return new Response("<p> Add Product </P>");
        }

        return $this->render('san_pham/index.html.twig', [
            'sp_form' => $form-> createView(),
        ]);
    }
    #[Route('/san/pham/list', name: 'app_list_san_pham')]
    public function list_sp(EntityManagerInterface $em, Request $req): Response
    {
        $query = $em -> createQuery('SELECT sp FROM App\Entity\SanPham sp');
        $lSp = $query-> getResult();
        $message = $req->query->get('message');
        return $this->render('san_pham/list.html.twig', [
            "data"=>$lSp,
            "message"=>$message
        ]);
    }
    #[Route('/san/pham/{id}/edit', name: 'app_edit_san_pham')]
    public function edit(EntityManagerInterface $em, int $id, Request $req , FileUploader $fileUploader): Response
    {
        $sp = $em-> find(SanPham::class, $id);
        $form = $this-> createForm(SanPhamType::class, $sp);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $file = $form->get("Photo")->getData();
            if ($file){
                $fileName = $fileUploader->upload($file);
                $data->setPhoto($fileName);

            }

            $sp->setName($data->getName())->setPrice($data->getPrice());
            $em->flush();
            return new RedirectResponse($this->urlGenerator->generate('app_list_san_pham'));}
        return $this->render('san_pham/index.html.twig', [
            "sp_form"=>$form->createView()
        ]);
    }
#[Route('/san/pham/{id}/delete', name: 'app_delete_san_pham')]
    public function delete(EntityManagerInterface $em, int $id, Request $req ): Response
    {
        $sp = $em-> find(SanPham::class, $id);
        $em->remove($sp);
        $em->flush();
        return new RedirectResponse($this->urlGenerator->generate('app_list_san_pham'));
    }
    #[Route('/cate/{id}', name: 'app_list_category')]
    public function listSPinCate(EntityManagerInterface $em, int $id, Request $req): Response
    {
        $cate = $em -> find(Category:: class, $id);
        $lSp = $cate-> getSanPhams();

        return $this->render('san_pham/list.html.twig', [
            "data"=>$lSp
        ]);
    }
}
