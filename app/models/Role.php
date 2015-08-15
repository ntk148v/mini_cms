<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    /**
     * Provide an array of strings that map to valid roles.
     * @param array $roles
     * @return stdClass
     */
    public function validateRoles( array $roles )
    {
        $user = Confide::user();
        $roleValidation = new stdClass();
        foreach( $roles as $role )
        {
            $roleValidation->$role = ( empty($user) ? false : $user->hasRole($role) );
        }
        return $roleValidation;
    }
}