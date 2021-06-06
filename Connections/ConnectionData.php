<?php

namespace Codememory\Database\Redis\Connections;

use Codememory\Database\Redis\Interfaces\ConnectionDataInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Class ConnectionData
 * @package Codememory\Database\Redis
 *
 * @author  Codememory
 */
class ConnectionData implements ConnectionDataInterface
{

    public const DEFAULT_CONNECTION_PORT = 6379;

    /**
     * @var string
     */
    private string $host;

    /**
     * @var int
     */
    private int $port;

    /**
     * @var ?string
     */
    private ?string $username;

    /**
     * @var ?string
     */
    private ?string $password;

    /**
     * @var int
     */
    private int $reconnectDelay;

    /**
     * @var bool
     */
    private bool $isTls;

    /**
     * ConnectionData constructor.
     */
    public function __construct()
    {

        $this->host = env('redis.host');
        $this->port = (int) env('redis.port') ?: self::DEFAULT_CONNECTION_PORT;
        $this->username = env('redis.username');
        $this->password = env('redis.password');
        $this->reconnectDelay = (int) env('redis.delay') ?: 0;
        $this->isTls = env('redis.tls') ?: false;

    }

    /**
     * @return string
     */
    #[Pure]
    public function getHost(): string
    {

        if($this->isTls()) {
            return sprintf('tls://%s', $this->host);
        }

        return $this->host;

    }

    /**
     * @return int
     */
    public function getPort(): int
    {

        return $this->port;

    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {

        return $this->username;

    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {

        return $this->password;

    }

    /**
     * @return int
     */
    public function reconnectDelay(): int
    {

        return $this->reconnectDelay;

    }

    /**
     * @return bool
     */
    public function isTls(): bool
    {

        return $this->isTls;

    }

}