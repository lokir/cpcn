<?php
declare(strict_types=1);

namespace Lmh\Cpcn\Support;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class Logger extends MonologLogger
{
    public function __construct(array $config = [])
    {
        $name = $config['log_name'] ?? 'cpcn';
        $logLevel = $config['log_level'] ?? MonologLogger::DEBUG;
        $logPath = $config['log_path'] ?? sys_get_temp_dir() . '/cpcn.log';

        $handler = new StreamHandler($logPath, $logLevel);

        $formatter = new LineFormatter(
            "[%datetime%] %channel%.%level_name%: %message% %context%\n",
            'Y-m-d H:i:s',
            true,
            true
        );
        $handler->setFormatter($formatter);

        parent::__construct($name, [$handler]);
    }
}
