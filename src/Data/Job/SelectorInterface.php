<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\JobInterface;

interface SelectorInterface
{
    public function getNextJobToWork(): JobInterface;

    public function hasWorkableJob(): bool;

    public function pick(): SelectorInterface;
}