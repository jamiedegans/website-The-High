<?php
// Store your login credentials here
$credentials = [
    'testadmin@gmail.com' => [
        'password' => password_hash('password', PASSWORD_DEFAULT),
        'role'     => 'admin'
    ]
];
