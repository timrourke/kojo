<?php

namespace NHDS\Jobs\AutoSchedule\Sqs;

use NHDS\Jobs\Data\AutoSchedule\Sqs;

class Worker implements WorkerInterface
{
    use Sqs\AwareTrait;

    public function work(): WorkerInterface
    {

        return $this;
    }
}