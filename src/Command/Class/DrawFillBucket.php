<?php declare(strict_types = 1);

namespace App\Command;

use Symfony\Component\String\Exception\InvalidArgumentException;
use App\Command\DrawingToolInterface;

class DrawFillBucket implements DrawingToolInterface {

    private $x;
    private $y;
    private $c;
    private $canvas;

    public function __construct($arguments) {
        $this->x=(int)$arguments['params']['1'];
        $this->y=(int)$arguments['params']['2'];
        $this->c=$arguments['params']['3'];
        $this->canvas=$arguments['canvas'];
    }

    public function execute():void {
        if (empty($this->canvas)) {
            throw new \RuntimeException('Canvas has not been created.');
        }
        $this->floodFill($this->x, $this->y, $this->c);
    }

    private function floodFill($x, $y, $c): void {
        if ($x < 1 || $x > count($this->canvas->getCanvas()[0]) - 2 || $y < 1 || $y > count($this->canvas->getCanvas()) - 2) {
            return;
        }

        if ($this->canvas->getCanvas()[$y][$x] != ' ' && $this->canvas->getCanvas()[$y][$x] != '-') {
            return;
        }

        $this->canvas->setCanvas($y, $x, $c);

        $this->floodFill($x + 1, $y, $c);
        $this->floodFill($x - 1, $y, $c);
        $this->floodFill($x, $y + 1, $c);
        $this->floodFill($x, $y - 1, $c);
    }
}