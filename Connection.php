<?php

namespace Codememory\Database\Redis;

use Codememory\Database\Redis\Connections\ConnectionData;
use Codememory\Database\Redis\Exceptions\IncorrectRedisHostOrPortException;
use Codememory\Database\Redis\Exceptions\IncorrectRedisPasswordOrUsernameException;
use Codememory\Database\Redis\Interfaces\ConnectionDataInterface;
use Codememory\Database\Redis\Interfaces\ConnectionRedisInterface;
use Redis;
use RedisException;

/**
 * Class Connection
 * @package Codememory\Database\Redis
 *
 * @author  Codememory
 */
class Connection implements ConnectionRedisInterface
{

    /**
     * @var Redis
     */
    private Redis $redis;

    /**
     * @var ConnectionDataInterface
     */
    private ConnectionDataInterface $connectionData;

    /**
     * @var bool
     */
    private bool $isConnect = false;

    /**
     * Connection constructor.
     *
     * @param Redis $redis
     */
    public function __construct(Redis $redis)
    {

        $this->redis = $redis;
        $this->connectionData = new ConnectionData();

    }

    /**
     * @param string     $operation
     * @param string     $key
     * @param mixed|null $value
     *
     * @return ConnectionRedisInterface
     */
    public function setConfig(string $operation, string $key, mixed $value = null): ConnectionRedisInterface
    {

        $this->redis->config($operation, $key, $value);

        return $this;

    }

    /**
     * @inheritDoc
     * @throws IncorrectRedisHostOrPortException
     * @throws IncorrectRedisPasswordOrUsernameException
     */
    public function makeConnection(): Redis
    {

        $this->connect();

        if (!empty($this->connectionData->getUserName()) || !empty($this->connectionData->getPassword())) {
            $this->authentication();
        } else if (false === $this->isConnect()) {
            throw new IncorrectRedisHostOrPortException();
        }

        return $this->redis;

    }

    /**
     * @inheritDoc
     */
    public function isConnect(): bool
    {

        return $this->isConnect;

    }

    /**
     * @inheritDoc
     */
    public function getRedis(): Redis
    {

        return $this->redis;

    }

    /**
     * @return void
     */
    private function connect(): void
    {

        $this->redis->connect(
            $this->connectionData->getHost(),
            $this->connectionData->getPort(),
        );

        $this->saveConnectionSate(function () {
            $this->redis->ping();
        });

    }

    /**
     * @return void
     * @throws IncorrectRedisPasswordOrUsernameException
     */
    private function authentication(): void
    {

        $this->saveConnectionSate(function () {
            $this->redis->auth([
                $this->connectionData->getUserName(),
                $this->connectionData->getPassword()
            ]);
        });

        if (!$this->isConnect()) {
            throw new IncorrectRedisPasswordOrUsernameException();
        }

    }

    /**
     * @param callable $callback
     */
    private function saveConnectionSate(callable $callback): void
    {

        try {
            call_user_func($callback);

            $this->isConnect = true;
        } catch (RedisException) {
            $this->isConnect = false;
        }

    }

}