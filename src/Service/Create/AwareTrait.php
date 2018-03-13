<?php
declare(strict_types=1);

namespace NHDS\Jobs\Service\Create;

use NHDS\Jobs\Api\Service\CreateInterface;

trait AwareTrait
{
    public function setServiceCreate(CreateInterface $create)
    {
        $this->_create(CreateInterface ::class, $create);

        return $this;
    }

    protected function _getServiceCreate(): CreateInterface
    {
        return $this->_read(CreateInterface ::class);
    }

    protected function _getServiceCreateClone(): CreateInterface
    {
        return clone $this->_getServiceCreate();
    }

    protected function _unsetServiceCreate()
    {
        $this->_delete(CreateInterface::class);

        return $this;
    }
}