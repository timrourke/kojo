<?php
declare(strict_types=1);

namespace NHDS\Jobs\Scheduler;

use NHDS\Jobs\SchedulerInterface;

trait AwareTrait
{
    public function setScheduler(SchedulerInterface $scheduler)
    {
        $this->_create(SchedulerInterface::class, $scheduler);

        return $this;
    }

    protected function _getScheduler(): SchedulerInterface
    {
        return $this->_read(SchedulerInterface::class);
    }

    protected function _getSchedulerClone(): SchedulerInterface
    {
        return clone $this->_getScheduler();
    }

    protected function _hasScheduler(): bool
    {
        return $this->_exists(SchedulerInterface::class);
    }

    protected function _deleteScheduler()
    {
        $this->_delete(SchedulerInterface::class);

        return $this;
    }
}