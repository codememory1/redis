<?php

namespace Codememory\Database\Redis\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class RedisConnectionException
 * @package Codememory\Database\Redis\Exceptions
 *
 * @author  Codememory
 */
abstract class RedisConnectionException extends ErrorException
{

    /**
     * RedisConnectionException constructor.
     *
     * @param string $message
     * @param int    $code
     */
    #[Pure]
    public function __construct(string $message, int $code = 0)
    {

        parent::__construct($message, $code);

    }

    /**
     * @return string
     */
    abstract public function getType(): string;

}