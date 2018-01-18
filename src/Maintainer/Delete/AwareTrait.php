<?php
declare(strict_types=1);

namespace NHDS\Jobs\Maintainer\Delete;

use NHDS\Jobs\Maintainer\DeleteInterface;

trait AwareTrait
{
    public function setMaintainerDelete(DeleteInterface $delete)
    {
        $this->_create(DeleteInterface::class, $delete);

        return $this;
    }

    public function hasMaintainerDelete(): bool
    {
        return $this->_exists(DeleteInterface::class);
    }

    protected function _getMaintainerDeleteClone(): DeleteInterface
    {
        return clone $this->_getMaintainerDelete();
    }

    protected function _getMaintainerDelete(): DeleteInterface
    {
        return $this->_read(DeleteInterface::class);
    }

    protected function _deleteMaintainerDelete()
    {
        $this->_delete(DeleteInterface::class);

        return $this;
    }
}