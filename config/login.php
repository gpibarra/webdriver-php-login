<?php

return [


    'Twitter' => [
        'login' => [
            'url' => 'https://twitter.com/login',
            'form' => [
                'input' => [
                    'username' => [
                        'search' => 'selector',
                        'target' => 'input.js-username-field',
//                        'search' => 'name',
//                        'target' => 'session[username_or_email]',
                        'type' => 'text'
                    ],
                    'password' => [
                        'search' => 'selector',
                        'target' => 'input.js-password-field',
//                        'search' => 'name',
//                        'target' => 'session[password]',
                        'type' => 'pass'
                    ]
                ],
                'submit' => [
                    'type' => 'button',
                    'search' => 'selector',
                    'target' => 'button.submit'
                ]
            ],
            'check' => [
                'type' => 'url',
                'compare' => 'equal',
                'exist' => true,
                'url' => 'https://twitter.com/',
            ]
        ],
        'logout' => [
        ]
    ],

    'Facebook' => [
        'login' => [
            'url' => 'https://www.facebook.com/login.php',
            'form' => [
                'input' => [
                    'username' => [
                        'search' => 'id',
                        'target' => 'email',
                        'type' => 'text'
                    ],
                    'password' => [
                        'search' => 'id',
                        'target' => 'pass',
                        'type' => 'pass'
                    ],
                ],
                'submit' => [
                    'type' => 'button',
                    'search' => 'id',
                    'target'=>'loginbutton'
                ]
            ],
            /* * /
            'check' => [
                'type' => 'url',
                'compare' => 'equal',
                'exist' => true,
                'url' => 'https://www.facebook.com/',
            ]
            /* */
            /* * /
            'check' => [
                'type' => 'url',
                'compare' => 'match',
                'exist' => false,
                'match' => 'login.php',
            ]
            /* */
            /* */
            'check' => [
                'type' => 'element',
                'exist' => false,
                'search' => 'id',
                'target' => 'pass',
            ]
            /* */
            /* * /
            'check' => [
                'type' => 'element',
                'exist' => true,
                'search' => 'id',
                'target' => 'mainContainer',
            ]
            /* */
        ],
        'logout' => [
        ]
    ],

    'PagoMisCuentas' => [
        'login' => [
            'url' => 'https://paysrv2.pagomiscuentas.com/Inicio.html',
            'frame' => 'pmctas',
            'form' => [
                'input' => [
                    'bank' => [
                        'search' => 'id',
                        'target' => 'bank',
                        'type' => 'select',
                        'selectBy' => 'value'
                    ],
                    'docType' => [
                        'search' => 'id',
                        'target' => 'docType',
                        'type' => 'select',
                        'selectBy' => 'text'
                    ],
                    'username' => [
                        'search' => 'id',
                        'target' => 'docNumberScreen',
                        'type' => 'text'
                    ],
                    'password' => [
                        'search' => 'id',
                        'target' => 'passwordScreen',
                        'type' => 'pass'
                    ]
                ],
                'submit' => [
                    'type' => 'button',
                    'search' => 'selector',
                    'target'=>'input.bt-ingresar-form'
                ]
            ],
            'check' => [
                'type' => 'element',
                'exist' => false,
                'search' => 'selector',
                'target' => 'a.bt-volver',
            ]
        ],
        'logout' => [
        ]
    ]


];
