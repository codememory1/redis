<?php

namespace Codememory\Database\Redis\Exceptions;

use Codememory\Database\Redis\RedisManager;
use JetBrains\PhpStorm\Pure;

/**
 * Class IncorrectRedisHostOrPortException
 * @package Codememory\Database\Redis\Exceptions
 *
 * @author  Codememory
 */
class IncorrectRedisHostOrPortException extends RedisConnectionException
{

    /**
     * IncorrectRedisHostOrPortException constructor.
     */
    #[Pure]
    public function __construct()
    {

        parent::__construct('Incorrect host or port for connecting to redis');

    }

    /**
     * @return string
     */
    public function getType(): string
    {

        return RedisManager::AUTH_ERROR_IUD;

    }

}