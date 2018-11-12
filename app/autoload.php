<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';
include_once __DIR__ . '/../vendor/urvin/m3u/src/M3uException.php';
include_once __DIR__ . '/../vendor/urvin/m3u/src/M3uEntry.php';
include_once __DIR__ . '/../vendor/urvin/m3u/src/M3u.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
