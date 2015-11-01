<?php

$collection = $app['controllers_factory'];

$collection->get('/', function () {
    return "Index page";
});

return $collection;