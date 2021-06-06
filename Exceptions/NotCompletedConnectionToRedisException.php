<?php

namespace Codememory\Database\Redis\Exceptions;

use JetBrains\PhpStorm\Pure;
use RedisException;

/**
 * Class NotCompletedConnectionToRedisException
 * @package Codememory\Database\Redis\Exceptions
 *
 * @author  Codememory
 */
class NotCompletedConnectionToRedisException extends RedisException
{

    /**
     * NotCompletedConnectionToRedisException constructor.
     */
    #[Pure]
    public function __construct()
    {

        parent::__construct('Before using redis manager, you need to connect to redis');

    }

}