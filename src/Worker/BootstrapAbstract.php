<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

use Neighborhoods\Toolkit\Data\Property\Strict;
use Neighborhoods\Kojo\Db\Connection\Container;
use Neighborhoods\Kojo\Foreman;

abstract class BootstrapAbstract implements BootstrapInterface
{
    use Container\AwareTrait;
    use Foreman\AwareTrait;
    use Strict\AwareTrait;
    const PROP_PDO = 'pdo';

    abstract public function instantiate(): BootstrapInterface;

    public function setPdo(\PDO $pdo): BootstrapInterface
    {
        $this->_create(self::PROP_PDO, $pdo);
        $this->_getDbConnectionContainer('job')->setPdo($pdo);

        return $this;
    }
}