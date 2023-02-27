<?php

return [
    '__name' => 'admin-otp',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/admin-otp.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://github.com/iqbalfn'
    ],
    '__files' => [
        'modules/admin-otp' => ['install','update','remove'],
        'theme/admin/otp' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-otp' => NULL
            ],
            [
                'admin' => NULL
            ],
            [
                'lib-form' => NULL
            ],
            [
                'lib-pagination' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'AdminOtp\\Controller' => [
                'type' => 'file',
                'base' => 'modules/admin-otp/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'admin' => [
            'adminOtpIndex' => [
                'path' => [
                    'value' => '/otp'
                ],
                'handler' => 'AdminOtp\\Controller\\Otp::index',
                'method' => 'GET'
            ]
        ]
    ],
    'adminUi' => [
        'sidebarMenu' => [
            'items' => [
                'otp' => [
                    'label' => 'OTP',
                    'icon' => '<i class="fa fa-key" aria-hidden="true"></i>',
                    'route' => ['adminOtpIndex',[],[]],
                    'priority' => 0,
                    'perms' => 'otp_read',
                    'filterable' => TRUE,
                    'visible' => TRUE
                ]
            ]
        ]
    ],
    'libForm' => [
        'forms' => [
            'admin.otp.index' => [
                'q' => [
                    'label' => 'Search',
                    'type' => 'search',
                    'nolabel' => TRUE,
                    'rules' => []
                ]
            ]
        ]
    ]
];
