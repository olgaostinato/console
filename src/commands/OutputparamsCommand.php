<?php

namespace commands;

/**
 * класс выводит список аргументов и опций 
 * @author Rahmanova
 */
class OutputparamsCommand extends Command
{

    public $name;  
    public $description;  
        
    public function __construct() 
    {
        $this->name = "output_params";
        $this->description = "выводит список опций и аргументов \n";
    }
        
    public function execute($arguments = [], $options = []) 
    {
        echo "Called command:" . $this->name ."\n\n";
        echo "Arguments:\n";
        foreach ($arguments as $argument) {
            echo "    - ".$argument."\n";
        }
        echo "\nOptions:\n";
        foreach ($options as $key => $option) {
            echo "    - ".$key."\n";
            foreach ($option as $item) {
                echo "       - ".$item."\n";
            }
        }
    }

    public function help() 
    {
        echo "описание метода " . $this->name . "\n - " .$this->description;
    }
}
