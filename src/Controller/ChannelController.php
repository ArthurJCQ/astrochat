<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ChannelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChannelController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function getChannels(ChannelRepository $channelRepository): Response
    {
        $channels = $channelRepository->findAll();

        return $this->render('home/index.html.twig', [
            'channels' => $channels ?? []
        ]);
    }
}
