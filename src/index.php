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

$db = new Nette\Database\Connection('sqlite:db_vote.db');

$db->query('CREATE TABLE IF NOT EXISTS widget (id int, name varchar)');

$res = $db->fetchAll('SELECT * FROM widget');

echo $twig->render('index', ['widgets' => $res]);
