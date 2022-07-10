<?php
/**
 * класс для обработки консольных комманд
 * @author Rahmanova
 */
class Console
{
    /**
     * список аргументов
     * @var array 
     */
    protected $arguments = [];
     /**
     * список опций
     * @var array 
     */
    protected $options = [];
    /**
     * список зарегистрированных комманд
     * @var array 
     */
    private $commandslist;
    /**
     * имя текущей команды
     * @var string
     */
    private $current;

    public function __construct(array $params = [])
    {
        unset($params[0]);
        $this->current = array_shift($params); 
        $this->parceParams($params);
    }
    /**
     * метод парсинга входящих параметров
     * @return void
     */
    private function parceParams(array $params) 
    {
        print_r($params);
        foreach ($params as $argument) {  
            preg_match('/[$|:]/', $argument, $matches);
            if (!empty($matches)) {
                echo "некоректный параметр  в ".$argument."\n";
                continue;    
            }
            preg_match('/^\{[\w@,]*\}$/', $argument, $matches);    
            if (!empty($matches)) {
                 $this->arguments[] = substr($matches[0], 1, -1);
                 continue;
            }
            preg_match('/^\[(.+)=(.+)*\]$/', $argument, $matches);         
            if (!empty($matches)) {
                $this->options[$matches[1]][] = $matches[2];
                continue;
            }
            $this->arguments[] = $argument; 
        }
    }

    /**
    * выводит на экран список зарегистрированных комманд
    * @return void
    */
    public function help()
    {
        foreach ($this->commandslist as $item) {
            echo $item->name ." - ". $item->description;
        }       
    }

    /**
    * регистрирует комманду
    * @return void
    */  
    public function addcommand($command) 
    {
        $this->commandslist[$command->name] = $command;
    }

    /**
    * запускает текущую комманду, при наличие атрибута {help} запускает метод help текущей команды
    * @return void
    */  
    public function execute() 
    {
        if (isset($this->commandslist[$this->current])) {
            $class = $this->commandslist[$this->current];
            if (array_search('help', $this->arguments) !== false) {
                $class->help();
            } else {
                $class->execute($this->arguments,$this->options);
            }
        } else {
            $this->help();
        }    
    }
}
