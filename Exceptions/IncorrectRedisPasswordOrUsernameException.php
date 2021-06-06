<?php

namespace Codememory\Database\Redis\Exceptions;

use Codememory\Database\Redis\RedisManager;
use JetBrains\PhpStorm\Pure;
use RedisException;

/**
 * Class IncorrectRedisPasswordOrUsernameException
 * @package Codememory\Database\Redis\Exceptions
 *
 * @author  Codememory
 */
class IncorrectRedisPasswordOrUsernameException extends RedisConnectionException
{

    /**
     * IncorrectRedisPasswordOrUsernameException constructor.
     */
    #[Pure]
    public function __construct()
    {

        parent::__construct('Incorrect password or username for redis');

    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {

        return RedisManager::AUTH_ERROR_IHOP;

    }

}