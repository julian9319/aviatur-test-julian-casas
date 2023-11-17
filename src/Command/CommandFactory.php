<?php declare(strict_types = 1);

namespace App\Command;

use App\Command\DrawingToolInterface;

class CommandFactory
{
    private $sufix;
    private $DS;

    public function __construct() {
        $this->prefix='Draw';
        $this->DS='\\'; 
    }

    public function createMethod($class, $arguments): DrawingToolInterface {
        $classDefinition=__NAMESPACE__.$this->DS.$this->prefix.$class;
       
        if (class_exists($classDefinition)) {
            return new $classDefinition($arguments);
        } else {
            throw new \Exception ('Draw custom class not found.');
        }
    }
}