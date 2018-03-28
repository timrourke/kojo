<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

use Neighborhoods\Kojo\Data\JobInterface;

interface LocatorInterface
{
    public function setJob(JobInterface $job);

    public function getCallable(): callable;
}