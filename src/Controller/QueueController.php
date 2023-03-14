<?php
namespace App\Controller;
use App\Message\QueueMessage;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class QueueController
{
    private $messageBus;
    private $logger;

    public function __construct(MessageBusInterface $messageBus,LoggerInterface $logger)
    {
        $this->messageBus = $messageBus;
        $this->logger = $logger;
    }

    /**
     * @Route("/queue", name="queue_index")
     */
    public function index()
    {
        // Count the number of pending messages in the default transport
        $message = new QueueMessage("hello");
        $this->messageBus->dispatch($message);

        print_r('Message queued');

        return new Response(sprintf('Message with content %s was published', $message->getContent()));
    
    }
}