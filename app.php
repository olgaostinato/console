<?php

ini_set('error_reporting', E_ALL);

require __DIR__.'/autoload.php';

$console = new Console($argv);
//регистрируем команду
$console->addcommand(new \commands\OutputparamsCommand());
//....
$console->execute();
