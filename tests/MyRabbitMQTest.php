<?php
namespace App\Tests;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PHPUnit\Framework\TestCase;

class MyRabbitMQTest extends TestCase
{
    protected $connection;
    protected $channel;

    protected function setUp(): void
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('test_queue', false, true, false, false);
    }

    protected function tearDown(): void
    {
        $this->channel->queue_delete('test_queue');
        $this->channel->close();
        $this->connection->close();
    }

    public function testPublishMessage()
    {
        $message = new AMQPMessage('Hello, world!');

        $this->channel->basic_publish($message, '', 'test_queue');
       // $this->assertTrue($this->channel->basic_get('test_queue') !== null);
      
    }
}
