<?php

namespace Codememory\Database\Redis;

use Codememory\Database\Redis\Exceptions\NotCompletedConnectionToRedisException;
use Codememory\Database\Redis\Interfaces\ConnectionRedisInterface;
use Codememory\Database\Redis\Interfaces\RedisManagerInterface;
use Redis;

/**
 * Class RedisManager
 * @package Codememory\Database\Redis
 * @mixin Redis
 *
 * @author  Codememory
 */
class RedisManager implements RedisManagerInterface
{

    public const AUTH_ERROR_IUD = 'incorrect-userdata';
    public const AUTH_ERROR_IHOP = 'incorrect-host-or-port';

    /**
     * @var ConnectionRedisInterface
     */
    private ConnectionRedisInterface $connection;

    /**
     * @var Redis
     */
    private Redis $redis;

    /**
     * @var int|null
     */
    private ?int $ttl = null;

    /**
     * RedisManager constructor.
     *
     * @param ConnectionRedisInterface $connectionRedis
     *
     * @throws NotCompletedConnectionToRedisException
     */
    public function __construct(ConnectionRedisInterface $connectionRedis)
    {

        $this->connection = $connectionRedis;

        if (!$connectionRedis->isConnect()) {
            throw new NotCompletedConnectionToRedisException();
        }

        $this->redis = $this->connection->getRedis();

    }

    /**
     * @inheritDoc
     */
    public function selectDatabase(int $db): RedisManager
    {

        $this->redis->select($db);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function getCurrentDatabase(): int
    {

        return $this->redis->getDbNum();

    }

    /**
     * @inheritDoc
     */
    public function getServerInfo(?string $option = null): array
    {

        return $this->redis->info($option);

    }

    /**
     * @inheritDoc
     */
    public function setTTL(int $seconds): RedisManager
    {

        $this->ttl = $seconds;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function whenSuccessSet(string $key, mixed $value, callable $handler): RedisManager
    {

        if ($this->redis->set($key, $value, $this->ttl)) {
            call_user_func($handler);
        }

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function whenSetWithMyStatus(string $key, mixed $value, bool $status, callable $handler): RedisManager
    {

        if ($this->redis->set($key, $value, $this->ttl) === $status) {
            call_user_func($handler);
        }

        return $this;

    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return Redis
     */
    public function __call(string $method, array $arguments): mixed
    {

        return $this->redis->$method(...$arguments);

    }

}