<?php

$router = $di->getRouter();

$router->add(
    '/sign_up',
    [
        'controller' => 'register',
        'action' => 'index',
    ]
);

$router->add(
    '/stuff',
    [
        'controller' => 'index',
        'action' => 'index',
    ]
);

$router->add(
    '/change_password',
    [
        'controller' => 'password',
        'action' => 'index',
    ]
);

$router->add(
    '/',
    [
        'controller' => 'session',
        'action' => 'start',
    ]
);


$router->add(
    '/start',
    [
        'controller' => 'index',
        'action' => 'start',
    ]
);

$router->add(
    '/stop',
    [
        'controller' => 'index',
        'action' => 'stop',
    ]
);


$router->add(
    '/logout',
    [
        'controller' => 'session',
        'action' => 'logout',
    ]
);
// Define your routes here

$router->handle();
