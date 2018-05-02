<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Test\Application\Process\Strategy;

use Neighborhoods\Kojo\Process\StrategyInterface;

class Mock implements StrategyInterface
{
    public function fork(): int
    {
        return 12;
    }
}