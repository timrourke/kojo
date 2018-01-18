<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Service\Update\Hold;

use NHDS\Jobs\Data\Job\Service\Update\HoldInterface;
use NHDS\Jobs\Data\Job\State\ServiceInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setJobStateService(ServiceInterface $jobStateService);

    public function setUpdateHold(HoldInterface $updateHold);

    public function setName(string $factoryName): Service\FactoryInterface;

    public function create(): HoldInterface;
}