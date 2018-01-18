<?php
declare(strict_types=1);

namespace NHDS\Jobs\Semaphore\Resource;

use NHDS\Jobs\Semaphore\MutexInterface;
use NHDS\Jobs\Semaphore\ResourceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setMutex(MutexInterface $job);

    public function setSemaphoreResource(ResourceInterface $resource);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): ResourceInterface;
}