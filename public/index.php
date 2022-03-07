<?php

use Map\ModularSlim\Kernel;

if (file_exists($autoload = dirname(__DIR__) . '/vendor/autoload.php')) {
    require $autoload;
} else {
    $out = <<<HTML
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
             <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                         <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>ERROR 500: Internal Server Error</title>
</head>
<body>
  <h1>ERROR 500: Internal Server Error</h1>
  <p>
    Could not locate <a href="https://getcomposer.org">Composer's</a> autoloader. Please consult the documentation and
    verify you have installed this application properly! 
  </p>
</body>
</html>
HTML;
    header(
        header: 'HTTP/1.1 500 Internal Server Error',
        response_code: 500
    );
    exit($out);
}

$app = new Kernel();
$app->run();
