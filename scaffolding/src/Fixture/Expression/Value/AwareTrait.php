<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding\Fixture\Expression\Value;

trait AwareTrait
{
    protected $_expressionValues = [];

    public function addExpressionValue(string $valueName, $value)
    {
        if (isset($this->_expressionValues[$valueName])) {
            throw new \LogicException('Expression value with value name "' . $valueName . '" is already set."');
        }
        $this->_expressionValues[$valueName] = $value;

        return $this;
    }

    public function hasExpressionValues(): bool
    {
        return empty($this->_expressionValues) ? false : true;
    }

    public function &getExpressionValues(): array
    {
        if (empty($this->_expressionValues)) {
            throw new \LogicException('Expression values is empty.');
        }

        return $this->_expressionValues;
    }
}