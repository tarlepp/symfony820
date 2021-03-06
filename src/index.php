<?php

require __DIR__ . '/../vendor/autoload.php';

$template = <<<TEMPLATE
<html>
<body>
    <h1>There is total {{ widget|length }}!</h1>
    
    <p>
       {{ widget[0].name }}
    </p>
    
    <ul>
    {% for w in widget %}
        <li>{{ w.name|e }}</li>
    {% endfor %}
    </ul>
</body>
</html>
TEMPLATE;

$loader = new Twig_Loader_Array([
    'index' => $template,
]);

$twig = new Twig_Environment($loader);

$db = new Nette\Database\Connection('sqlite:db_vote.db');
$db->query('CREATE TABLE IF NOT EXISTS widget (id int, name varchar)');
$db->query('INSERT INTO widget (id, name) VALUES (1, \'some name - ' . time() . '\')');

$res = $db->fetchAll('SELECT * FROM widget');

echo $twig->render('index', ['widget' => $res]);
