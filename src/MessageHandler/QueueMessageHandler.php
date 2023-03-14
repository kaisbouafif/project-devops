<?php 

namespace App\MessageHandler;

use App\Message\QueueMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class QueueMessageHandler implements MessageHandlerInterface
{
    public function __invoke(QueueMessage $message)
    {
        // Simulate a time-consuming task by sleeping for 10 seconds
        sleep(10);
    }
}