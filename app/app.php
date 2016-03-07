<?php
    require_once __DIR__.'/../vendor/autoload.php';

    $server = 'mysql:host=locahost;dbname=discogs';
    $user = 'root';
    $password = 'root';
    $DB = new PDO($server, $user, $password);

    $app = new Silex\Application();

    use Symfony\Component\HttpFoundation\Request;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/views',
    ));


    return $app;
?>
