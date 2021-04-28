<?php

declare(strict_types=1);

namespace EasyAdmin\Application\Logger;

use EasyAdmin\Domain\Database\Exception\QueryException;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;

final class Logger extends MonologLogger implements LoggerInterface
{
    public function __construct()
    {
        parent::__construct('');

        $dateFormat = "Y-m-d H:i:s";
        $output = "[%datetime%] %level_name%%context% | %message%\n%extra%\n";
        $formatter = new LineFormatter($output, $dateFormat, true);

        $handler = new StreamHandler('var/log/info.log', self::INFO);
        $handler->setFormatter($formatter);
        $this->pushHandler($handler);

        $this->pushProcessor(new WebProcessor());
        $this->pushProcessor(new IntrospectionProcessor(self::WARNING));
    }

    public function queryError(QueryException $exception): void
    {
        $this->error($exception->getMessage(), ['database']);
        $this->error($exception->getQuery(), ['database']);
    }
}
