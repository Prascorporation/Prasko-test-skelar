<?php

namespace App\Facades;

class Response
{
    /**
     * Send a JSON response with the given data and HTTP status code.
     *
     * @param mixed $data The data to be encoded as JSON.
     * @param int $statusCode The HTTP status code.
     * @return void
     */
    public static function json(mixed $data, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Send a text response with the given message and HTTP status code.
     *
     * @param string $message The message to be sent.
     * @param int $statusCode The HTTP status code.
     * @return void
     */
    public static function text(string $message, int $statusCode): void
    {
        http_response_code($statusCode);
        echo $message;
    }
}
