<?php
namespace Trunow\Shopvam\Contracts;
/**
 * Interface UserPermissionsContract
 * @package Trunow\Shopvam\Contracts
 */
interface UserPermissionsContract
{
    /**
     * Get the currently user permissions.
     *
     * @return array
     */
    public function permissions();

    /**
     * Get the currently user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user();

    /**
     * Get the currently user type.
     *
     * @return string
     */
    public function type();

    /**
     * Determine if the current user is have permission to action.
     *
     * @return bool
     */
    public function check($action = '');

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setPermissions(array $permissions = []);

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user);

    /**
     * Set the current user type.
     *
     * @param  string  $type
     * @return void
     */
    public function setType($type);
}