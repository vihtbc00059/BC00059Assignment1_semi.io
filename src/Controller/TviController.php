<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TviController extends AbstractController
{
    #[Route('/tvi', name: 'app_tvi')]
    public function req(Request $req): Response
    {
        $a = $req->query->get('a');
        $at2 = $a * $a;
        return $this->render('tvi/index.html.twig', [
            'a' => $at2,
        ]);
    }


    
    #[Route('/phpcode', name: 'app_code')]
    public function phpcode(): Response
    {
        return new Response('<p>Hôm nay tui cô đơn quá</p>',
        Response:: HTTP_FORBIDDEN);
    }
}
