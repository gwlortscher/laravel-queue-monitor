<?php
namespace JKatzen\QueueMonitor;

use Predis;

class QueueRedisStatus
{
    /**
     * @var string
     */
    protected $queueName;

    /**
     * @var Predis\Client
     */
    protected $client;


    public function __construct($queueName)
    {
        $this->queueName = $queueName;
        $redisConfig = config('database.redis.default');
        $connection = 'tcp://'.$redisConfig['host'].':'.$redisConfig['port'];
        $this->client = new Predis\Client($connection);
    }

    public function getMessageCount()
    {
        $this->client->llen('queues:'.$this->queueName);
    }

    public function resetMessageQueue()
    {
        $this->client->del('queues'.$this->queueName);
    }
}
