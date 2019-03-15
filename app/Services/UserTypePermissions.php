<?php
namespace App\Services;

use Trunow\Shopvam\Contracts\UserPermissionsContract;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserTypePermissions
 * Проверка прав по типу пользователя
 */
class UserTypePermissions implements UserPermissionsContract
{
    public $user;
    public $type;
    public $default_type = 'default';
    public $permissions;

    public function __construct()
    {
        $this->setUser(Auth::user());
        $this->setPermissions(config('shopvam'));
    }

    /**
     * Get the currently user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Get the currently user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Get the currently user permissions.
     *
     * @return array
     */
    public function permissions()
    {
        return $this->permissions;
    }

    /**
     * Determine if the current user is have permission to action.
     *
     * @return bool
     */
    public function check($action = '')
    {
        $action_field = explode('.', trim($action,"' "));
        $_action = $action_field[0] ?? null;
        $_field = $action_field[1] ?? null;

        $permissions = $this->permissions();
        $_permission = false;


        if($_action)
        {
            //$_permission = !isset($permissions[$_action]) ?: !!$permissions[$_action];

            $_permissions = $permissions[$_action] ?? null;
            $_permission = ($_permissions) ? !!$_permissions : $_permission;

            if($_field && is_array($_permissions))
            {
                $_permission = (isset($_permissions[$_field])) ? !!$_permissions[$_field] : false;//$_permission;
            }
        }

        return $_permission;
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setPermissions(array $permissions = [])
    {
        $this->setType($permissions['users'][$this->user()->name] ?? null);
        $this->permissions = $permissions['permissions'][$this->type];
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser($user)
    {
        $this->user = Auth::user();
    }

    /**
     * Set the current user type.
     *
     * @param  string  $type
     * @return void
     */
    public function setType($type = null)
    {
        $this->type = $type ?? $this->default_type;
    }
}