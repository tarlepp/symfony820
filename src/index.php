<?php

require __DIR__ . '/../vendor/autoload.php';

$loader = new Twig_Loader_Array([
    'index' => 'There is total {{ widgets|length }}!',
]);

$twig = new Twig_Environment($loader);

$widgets = [
    new stdClass(),
    new stdClass(),
    new stdClass(),
    new stdClass(),
];

echo $twig->render('index', ['widgets' => $widgets]);
