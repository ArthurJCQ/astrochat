<?php

namespace App\Controller;

use App\Entity\Channel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $channels = $this->getDoctrine()->getRepository(Channel::class)->findAll();

        return $this->render('home/index.html.twig', [
            'channels'           => $channels ?? []
        ]);
    }
}
