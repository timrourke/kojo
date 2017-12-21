<?php

namespace NHDS\Jobs\Data\Job\Service;

use NHDS\Jobs\Data\Job\Collection\ScheduleLimitInterface;
use NHDS\Jobs\Data\Job\ServiceInterface;
use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Jobs\Data\JobInterface;

interface CreateInterface extends ServiceInterface
{
    public function setJob(JobInterface $job);

    public function setJobType(TypeInterface $job);

    public function setJobCollectionScheduleLimit(ScheduleLimitInterface $jobCollectionScheduleLimit);

    public function setJobTypeCode(string $jobTypeCode): CreateInterface;

    public function save(): CreateInterface;

    public function setImportance(int $importance): CreateInterface;

    public function setWorkAtDateTime(\DateTime $workAtDateTime): CreateInterface;
}