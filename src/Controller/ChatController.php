<?php

namespace App\Controller;

use App\Entity\Channel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/{id}", name="chat")
     */
    public function chat(Request $request, Channel $channel): Response
    {
        return $this->render('chat/index.html.twig', [
            'channel' => $channel
        ]);
    }
}
