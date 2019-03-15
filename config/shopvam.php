<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Конфиг пакета trunow/shopvam
    |--------------------------------------------------------------------------
    |
    | Разрешения действий по типам пользователей (admin, manager)
    |
    */

    'permissions' => [
        'admin' => [
            'index' => true,
            'show' => true,
            'create' => true,
            'store' => true,
            'edit' => true,
            'update' => true,
            'destroy' => true,
        ],
        'manager' => [
            'index' => true,
            'show' => true,
            'create' => true,
            'store' => true,
            'edit' => [
                'name' => true
            ],
            'update' => [
                'name' => true
            ],
        ],
        'default' => [
            'index' => true,
            'show' => true,
        ],
    ],

    'users' => [
        'admin' => 'admin',
        'manager' => 'manager',
    ],

];