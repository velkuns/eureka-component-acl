<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Acl;

/**
 * Access Control Lists Rights.
 *
 * @author Romain Cottard
 */
class Right
{
    /**
     * @var integer NO_RIGHTS Bitmask value for no rights.
     */
    const NO_RIGHTS = 0;

    /**
     * @var integer $allRights Bitmask value for all rights.
     */
    protected static $allRights = 15;

    /**
     * @var array $rights List of rights name with bitmask value associated.
     */
    protected static $rights = array(
        'create' => 1, 'read' => 2, 'update' => 4, 'delete' => 8,
    );

    /**
     * Add new right in list
     *
     * @param string $name
     * @throws \Exception
     */
    public static function add($name)
    {
        if (isset(static::$rights[$name])) {
            throw new \Exception(__METHOD__ . '|Name for right already exists !');
        }

        static::$rights[$name] = static::$allRights + 1;
        static::$allRights     = ((static::$allRights + 1) * 2) - 1;
    }

    /**
     * Get bitmask value for right name.
     *
     * @param string $name
     * @return integer
     */
    public static function get($name)
    {
        if (!isset(static::$rights[$name])) {
            return static::NO_RIGHTS;
        }

        return static::$rights[$name];
    }

    /**
     * Helper method.
     * Return bitmask value for all rights.
     *
     * @return array
     */
    public static function all()
    {
        return array_values(static::$rights);
    }

    /**
     * Reset rights
     *
     * @return void
     */
    public static function reset()
    {
        static::$allRights = static::NO_RIGHTS;
        static::$rights    = array();
    }
}