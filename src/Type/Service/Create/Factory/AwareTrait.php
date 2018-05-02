<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type\Service\Create\Factory;

use Neighborhoods\Kojo\Type\Service\Create\FactoryInterface;

trait AwareTrait
{
    /** @injected:runtime */
    public function setTypeServiceCreateFactory(FactoryInterface $updateCrashFactory): self
    {
        $this->_create(FactoryInterface::class, $updateCrashFactory);

        return $this;
    }

    protected function _getTypeServiceCreateFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasTypeServiceCreateFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetTypeServiceCreateFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}