Freckles
================================

local.php
-------------------
```php
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=;dbname=',
            'username' => '',
            'password' => '',
        ],
        'request' => [
            'cookieValidationKey' => 'unicKey',
        ]
    ],
    'params' => [
        'users' => [
            '1' => [
                'id' => '1',
                'phone' => '',
                'authKey' => '',
                'accessToken' => '',
            ],
            '2' => [
                'id' => '2',
                'phone' => '',
                'authKey' => '',
                'accessToken' => '',
            ]
        ]
    ]
];
```