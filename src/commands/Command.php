<?php

namespace commands;

/**
 * абстрактный класс для команды
 * @author Rahmanova
 */
abstract class Command {

    public $name;
    public $description;

    abstract public function execute(array $arguments, array $options);
    abstract public function help();
}
