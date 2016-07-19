<?php
require __DIR__ . '/../vendor/autoload.php';

use \pillr\library\http\Response;

# TIP: Use the $_SERVER Sugerglobal to get all the data your need from the Client's HTTP Request.

# TIP: HTTP headers are printed natively in PHP by invoking header().
#      Ex. header('Content-Type', 'text/html');
#
#

$retval = array(
    "@id" => $_SERVER['REQUEST_URI'],
    "to" => "Pillr",
    "subject" => "Hello Pillr",
    "message" => "Here is my submission.",
    "from" => "Kun Xie",
    "timeSent" => time()
);
$body = json_encode($retval);

$headers = array(
    "Date" => date('D, d M Y H:i:s T'),
    "Last-Modified" => date('D, d M Y H:i:s T'),
    "Content-Length" => strlen($body),
    "Content-Type" => "application/json",
);

$response = new Response(
    "1.1",
    "200",
    "OK",
    $headers,
    $body
);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
