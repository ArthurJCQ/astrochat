<?php

namespace App\Controller;

use App\Entity\Channel;
use App\Repository\ChannelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChannelController extends AbstractController
{
    /**
     * @Route("/channels", name="home")
     */
    public function getChannels(ChannelRepository $channelRepository): Response
    {
        $channels = $channelRepository->findAll();

        $response = $this->render('home/index.html.twig', [
            'channels' => $channels ?? []
        ]);
        $response->headers->set('Link', ['<http://localhost:3000/.well-known/mercure>', 'rel="mercure"']);

        return $response;
    }

    /**
     * @Route("/chat/{id}", name="chat")
     */
    public function getChannel(Channel $channel): Response
    {
        return $this->render('chat/index.html.twig', [
            'channel' => $channel
        ]);
    }
}
