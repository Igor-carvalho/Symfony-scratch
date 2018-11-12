<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Process;

$live = "";
$hash = "";
if (isset($_REQUEST['app']) && $_REQUEST['app'] = 'streams') {
    // RTMP
    $live = $_REQUEST['tcurl'] . '/' . $_REQUEST['name'];
    $hash = $_REQUEST['t'];
} else {
    // HLS
    $extension = pathinfo($_SERVER['HTTP_X_ORIGINAL_URI'], PATHINFO_EXTENSION);
    if ($extension != 'ts') {
        $url = parse_url($_SERVER['HTTP_X_ORIGINAL_URI']);
        $live = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $url['path'];
        parse_str($url['query'], $args);
        $hash = $args['t'];
    } else {
        header("HTTP/1.0 200 OK");
        return;
    }
}

if ($live && $hash) {
    $command = "php console app:auth " . " --live " . $live . " --token=" . $hash;
    $process = new Process($command);
    $process->run();
    $response = $process->getOutput();

    header("HTTP/1.0 $response");
} else {
    header("HTTP/1.0 403 Forbidden");
}