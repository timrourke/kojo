<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\Pool\Logger\FormatterInterface;
use Neighborhoods\Kojo\ProcessInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Pylon\Time;
use Psr\Log;

class Logger extends Log\AbstractLogger implements LoggerInterface
{
    use Time\AwareTrait;
    use Logger\Message\Factory\AwareTrait;
    use Defensive\AwareTrait;
    const PROP_IS_ENABLED = 'is_enabled';

    protected $log_formatter;
    protected $level_filter_mask;

    public function setProcess(ProcessInterface $process): LoggerInterface
    {
        $this->_createOrUpdate(ProcessInterface::class, $process);

        return $this;
    }

    protected function _getProcess(): ProcessInterface
    {
        return $this->_read(ProcessInterface::class);
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->_isEnabled() === true) {
            if ($this->getLevelFilterMask()[$level] === false) {
                if ($this->_exists(ProcessInterface::class)) {
                    $processId = (string)$this->_getProcess()->getProcessId();
                } else {
                    $processId = '?';
                }

                $referenceTime = $this->_getTime()->getNow();
                $logMessage = $this->getProcessPoolLoggerMessageFactory()->create();
                $logMessage->setTime($referenceTime->format('D, d M y H:i:s.u T'));
                $logMessage->setLevel($level);
                $logMessage->setProcessId($processId);
                $logMessage->setProcessPath($this->_getProcess()->getPath());
                $logMessage->setMessage($message);
                fwrite(STDOUT, $this->getLogFormatter()->getFormattedMessage($logMessage) . "\n");
            }
        }

        return;
    }

    public function setLevelFilterMask(array $level_filter_mask): LoggerInterface
    {
        if ($this->level_filter_mask === null) {
            $this->level_filter_mask = $level_filter_mask;
        } else {
            throw new \LogicException('Logger level_filter_mask is already set.');
        }

        return $this;
    }

    protected function getLevelFilterMask(): array
    {
        if ($this->level_filter_mask === null) {
            $this->level_filter_mask = [];
        }

        return $this->level_filter_mask;
    }

    protected function _isEnabled(): bool
    {
        return $this->_read(self::PROP_IS_ENABLED);
    }

    public function setIsEnabled(bool $isEnabled): LoggerInterface
    {
        $this->_create(self::PROP_IS_ENABLED, $isEnabled);

        return $this;
    }

    public function getLogFormatter(): FormatterInterface
    {
        if ($this->log_formatter === null) {
            throw new \LogicException('Logger log_formatter has not been set.');
        }

        return $this->log_formatter;
    }

    public function setLogFormatter(FormatterInterface $log_formatter): LoggerInterface
    {
        if ($this->log_formatter !== null) {
            throw new \LogicException('Logger log_formatter already set.');
        }

        $this->log_formatter = $log_formatter;

        return $this;
    }
}
