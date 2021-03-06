<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Foreman;
use Neighborhoods\Kojo\Maintainer;
use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\Scheduler;
use Neighborhoods\Kojo\Selector;

class Job extends Forked implements JobInterface
{
    use Foreman\AwareTrait;
    use Maintainer\AwareTrait;
    use Scheduler\AwareTrait;
    use Selector\AwareTrait;
    use Process\Pool\Factory\AwareTrait;

    protected function _run() : Forked
    {
        try {
            $this->_getSelector()->setProcess($this);
            $this->_getMaintainer()->rescheduleCrashedJobs();
            $this->_getScheduler()->scheduleStaticJobs();
            $this->_getMaintainer()->updatePendingJobs();
            $this->_getMaintainer()->deleteCompletedJobs();
            $this->_getForeman()->workWorker();
        } catch (\Throwable $throwable) {
            $message = $this->_getLogger()->getLogFormatter()->getFormattedThrowableMessage($throwable);
            $this->_getLogger()->critical($message);
            $this->_setOrReplaceExitCode(255);
        }

        return $this;
    }
}
