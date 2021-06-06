<?php

namespace Codememory\Database\Redis\Interfaces;

use Redis;

/**
 * Interface ConnectionRedisInterface
 * @package Codememory\Database\Redis\Interfaces
 *
 * @author  Codememory
 */
interface ConnectionRedisInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set configuration for redis
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string     $operation
     * @param string     $key
     * @param mixed|null $value
     *
     * @return ConnectionRedisInterface
     */
    public function setConfig(string $operation, string $key, mixed $value = null): ConnectionRedisInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Make a connection to the redis server, if it fails to connect,
     * an exception will be thrown
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return Redis
     */
    public function makeConnection(): Redis;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Check connection status to redis server
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return bool
     */
    public function isConnect(): bool;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns a redis object
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return Redis
     */
    public function getRedis(): Redis;

}