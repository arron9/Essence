<?php
include 'index.php';
$http = new swoole_http_server("127.0.0.1", 9501);

$http->set([
    'worker_num' => 8,
]);

$http->on('request', function ($request, $response) {
    $app = new Plu\Admin\Application();
    $html = $app->main();
    $response->end($html);
});

$http->start();
