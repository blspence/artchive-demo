<?php

namespace App\Utilities;

use MyCLabs\Enum\Enum;

/**
 * Defines user roles and associated functions.
 * @link https://packagist.org/packages/myclabs/php-enum
 *
 * @package App\Utilities
 */
class Role extends Enum
{
    /**
     * User roles with higher integer values indicates more permissions;
     * Role is stored as an attribute of User in the database as the associated string:
     * e.g. Role::ADMIN() is stored as 'ADMIN'
     */
    private const USER = 0;
    private const ARCHIVIST = 1;
    private const ADMIN = 2;

    /**
     * Gets the user role object with the provided $key.
     *
     * @param string $key
     * @return Enum $role
     */
    public static function getRoleByKey(string $key)
    {
        foreach (Role::values() as $role)
        {
            if ($role->getKey() == $key)
            {
                return $role;
            }
        }

        // default to GUEST role if none found
        return self::USER;
    }

    public static function getRolesAsStr()
    {
        $roles = [];

        foreach (Role::values() as $role)
        {
            array_push($roles, $role->getKey());
        }

        return $roles;
    }

    /**
     * Returns true if the provided $role has necessary permissions.
     *
     * @param Role $role
     * @return bool
     */
    public function isAuthorized(Role $role)
    {
        return $this->getValue() >= $role->getValue();
    }

}
