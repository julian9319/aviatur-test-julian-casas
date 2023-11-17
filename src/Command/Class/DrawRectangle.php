<?php declare(strict_types = 1);

namespace App\Command;

use Symfony\Component\String\Exception\InvalidArgumentException;
use App\Command\DrawingToolInterface;

class DrawRectangle implements DrawingToolInterface {

    private $x1;
    private $y1;
    private $x2;
    private $y2;
    private $canvas;
    private $char;

    public function __construct($arguments) {
        $this->x1=(int)$arguments['params']['1'];
        $this->y1=(int)$arguments['params']['2'];
        $this->x2=(int)$arguments['params']['3'];
        $this->y2=(int)$arguments['params']['4'];
        $this->canvas=$arguments['canvas'];
        $this->char='x';
    }

    public function execute():void {

        // Draw top and bottom edges
        for ($i = $this->x1; $i <= $this->x2; $i++) {
            $this->canvas->setCanvas($this->y1, $i, $this->char);
            $this->canvas->setCanvas($this->y2, $i, $this->char);
        }

        // Draw left and right edges
        for ($i = $this->y1; $i <= $this->y2; $i++) {
            $this->canvas->setCanvas($i, $this->x1, $this->char);  
            $this->canvas->setCanvas($i, $this->x2, $this->char);
        }
    }
}