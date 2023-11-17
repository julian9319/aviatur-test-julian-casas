<?php declare(strict_types = 1);

namespace App\Command;

use Symfony\Component\String\Exception\InvalidArgumentException;
use App\Command\DrawingToolInterface;

class DrawLine implements DrawingToolInterface {

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
        if (!$this->canvas->areCoordinatesValid($this->x1, $this->y1) || !$this->canvas->areCoordinatesValid($this->x2, $this->y2)) {
            throw new InvalidArgumentException("Coordinates are outside the canvas area.");
        }

        if ($this->x1 == $this->x2) {
            // Vertical line
            for ($i = $this->y1; $i <= $this->y2; $i++) {
                $this->canvas->setCanvas($i, $this->x1, $this->char);
            }
        } elseif ($this->y1 == $this->y2) {
            
            // Horizontal line
            for ($i = $this->x1; $i <= $this->x2; $i++) {
                $this->canvas->setCanvas($this->y1, $i, $this->char);
            }
        } else {
            throw new InvalidArgumentException("Only horizontal or vertical lines are allowed.");
        }
    }
}
 