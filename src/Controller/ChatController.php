<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Channel;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/{id}", name="chat")
     */
    public function chat(Channel $channel, MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findBy([
            'channel' => $channel
        ], ['id' => 'ASC']);
        return $this->render('chat/index.html.twig', [
            'channel' => $channel,
            'messages' => $messages
        ]);
    }
}
