<?php

namespace Codememory\Database\Redis\Interfaces;

/**
 * Interface RedisManagerInterface
 * @package Codememory\Database\Redis\Interfaces
 *
 * @author  Codememory
 */
interface RedisManagerInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Select the database on which the other actions will be
     * performed: adding, retrieving data, etc.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $db
     *
     * @return RedisManagerInterface
     */
    public function selectDatabase(int $db): RedisManagerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the name of the selected database
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int
     */
    public function getCurrentDatabase(): int;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns server information
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string|null $option
     *
     * @return array
     */
    public function getServerInfo(?string $option = null): array;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Set TTL time for added records to the database
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $seconds
     *
     * @return RedisManagerInterface
     */
    public function setTTL(int $seconds): RedisManagerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Execute the handler after the record is successfully added to the database
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string   $key
     * @param mixed    $value
     * @param callable $handler
     *
     * @return RedisManagerInterface
     */
    public function whenSuccessSet(string $key, mixed $value, callable $handler): RedisManagerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Execute a handler after the state of adding a record to the
     * database matches $status
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string   $key
     * @param mixed    $value
     * @param bool     $status
     * @param callable $handler
     *
     * @return RedisManagerInterface
     */
    public function whenSetWithMyStatus(string $key, mixed $value, bool $status, callable $handler): RedisManagerInterface;

}