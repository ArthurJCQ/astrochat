<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Channel;
use App\Repository\ChannelRepository;
use App\Repository\MessageRepository;
use App\Services\Mercure\CookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
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
    public function chat(
        Request $request,
        Channel $channel,
        MessageRepository $messageRepository,
        CookieGenerator $cookieGenerator
    ): Response
    {
        $messages = $messageRepository->findBy([
            'channel' => $channel
        ], ['id' => 'ASC']);

        $hubUrl = $this->getParameter('mercure.default_hub');
        $this->addLink($request, new Link('mercure', $hubUrl));

        $response = $this->render('chat/index.html.twig', [
            'channel' => $channel,
            'messages' => $messages
        ]);
        $response->headers->setCookie(
            new Cookie(
                'mercureAuthorization',
                $cookieGenerator->generate(),
                new \DateTime('+1day'),
            )
        );
        return $response;
    }
}
