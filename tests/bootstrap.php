<?php

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . "/../vendor/autoload.php";

// Add test command builders to loader
$loader->addPsr4('TwitterBis\\Application\\Command\\Builder\\', __DIR__ . '/Application/Command/Builder/TestBuilders');