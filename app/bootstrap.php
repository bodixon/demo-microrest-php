<?php

use \Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\HttpFoundation\Response;

$app = new \Silex\Application();

$app['config'] = require_once(__DIR__.'/resources/config.php');

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => $app['config']['db']
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.options' => array('cache' => __DIR__.'/../var/cache/twig'),
));
$app->register(new Marmelab\Microrest\MicrorestServiceProvider(), array(
    'microrest.config_file' => __DIR__.'/resources/api.raml'
));


$app->get('/', function () use ($app) {
    return new Response("Index page");
});

$app->error(function (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getTraceAsString());
});

return $app;