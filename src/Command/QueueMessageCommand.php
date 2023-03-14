<?php
namespace App\Command;

use App\Message\QueueMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class QueueMessageCommand extends Command
{
    protected static $defaultName = 'app:queue-message';

    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Queues a message for the worker');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = new QueueMessage();
        $this->messageBus->dispatch($message);
        sleep(10);
        $output->writeln('Message queued');

        return 0;
    }
}