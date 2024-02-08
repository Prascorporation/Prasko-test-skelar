<?php

namespace App\Facades;

class Logger
{
    /**
     * Log a message to the application log.
     *
     * @param string $message
     * @return void
     */
    public static function log(string $message): void
    {
        if (! is_dir(__DIR__ . '/../../logs')) {
            mkdir(__DIR__ . '/../../logs');
        }
        $log = fopen(__DIR__ . '/../../logs/app.log', 'a');
        fwrite($log, PHP_EOL . $message  . ' ' . date('Y-m-d H:i:s'));
        fclose($log);
    }
}
