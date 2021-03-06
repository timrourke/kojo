<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Process\Pool\Logger;
use Neighborhoods\Kojo\Redis\Repository;

class Redis extends BrokerAbstract
{
    use Logger\AwareTrait;
    use Repository\AwareTrait;
    protected $_redisClient;

    public function waitForNewMessage(): BrokerInterface
    {
        try{
            $this->_getRedisClient()->brpoplpush(
                $this->_getPublishChannelName(),
                $this->_getSubscriptionChannelName(),
                0
            );
        }catch(\Exception $exception){
            $this->_getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $this;
    }

    protected function _getRedisClient(): \Redis
    {
        if ($this->_redisClient === null) {
            $this->_redisClient = $this->_getRedisRepository()->getById(BrokerInterface::class);
        }

        return $this->_redisClient;
    }

    public function hasMessage(): bool
    {
        try{
            $publishChannelLength = $this->getPublishChannelLength();
            $subscriptionChannelLength = $this->getSubscriptionChannelLength();
        }catch(\Exception $exception){
            $this->_getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $publishChannelLength + $subscriptionChannelLength > 0 ? true : false;
    }

    public function getNextMessage(): string
    {
        try{
            $message = $this->_getRedisClient()->lPop($this->_getSubscriptionChannelName());
            if ($message === false) {
                $message = $this->_getRedisClient()->rPop($this->_getPublishChannelName());
            }
        }catch(\Exception $exception){
            $this->_getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return (string)$message;
    }

    public function getPublishChannelLength(): int
    {
        try{
            $publishChannelLength = $this->_getRedisClient()->lLen($this->_getPublishChannelName());
        }catch(\Exception $exception){
            $this->_getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $publishChannelLength;
    }

    public function getSubscriptionChannelLength(): int
    {
        try{
            $subscriptionChannelLength = $this->_getRedisClient()->lLen($this->_getSubscriptionChannelName());
        }catch(\Exception $exception){
            $this->_getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $subscriptionChannelLength;
    }

    public function publishMessage($message): BrokerInterface
    {
        try{
            $this->_getRedisClient()->lPush($this->_getPublishChannelName(), $message);
        }catch(\Exception $exception){
            $this->_getLogger()->critical($exception->getMessage());
            throw $exception;
        }

        return $this;
    }
}