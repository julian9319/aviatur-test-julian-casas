<?php declare(strict_types = 1);

namespace App\Command;

class DrawCanvasSingleton
{
    private static ?DrawCanvasSingleton $instance = null;

    private $width;
    private $height;
    public $canvas;

    private function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
        $this->canvas = array_fill(0, $this->height + 2, array_fill(0, $this->width + 2, ' '));

        // Draw horizontal borders
        for ($i = 0; $i <= $this->width + 1; $i++) {
            $this->canvas[0][$i] = '-';
            $this->canvas[$this->height + 1][$i] = '-';
        }

        // Draw vertical borders
        for ($i = 1; $i <= $this->height; $i++) {
            $this->canvas[$i][0] = '|';
            $this->canvas[$i][$this->width + 1] = '|';
        }
    }

    public static function getInstance($width, $height): DrawCanvasSingleton {
        if (self::$instance === null) {
            self::$instance = new self($width, $height);
        }

        return self::$instance;
    }

  /**
   * Return canva width.
   * @return int
   */
    public function getWidth(): int {
        return $this->width;
    }

  /**
   * Return canva height.
   * @return int
   */
    public function getHeight(): int {
        return $this->height;
    }

  /**
   * Return canva array element.
   * @return array
   */
    public function getCanvas(): array {
        return $this->canvas;
    }

  /**
   * Set canva array.
   * @return array
   */
    public function setCanvas($i, $j, $c): void {
        $this->canvas[$i][$j] = $c;
    }

  /**
   * Return canva value as string.
   * @return array
   */
    public function getCanvasAsString(): string {
        if (empty($this->canvas)) {
            throw new \Exception ('Canva element is not created.');
        }
    
        $output = "";
        
        foreach ($this->canvas as $row) {
            $output .= implode("", $row) . PHP_EOL;
        }
        return $output;
    }

  /**
   * Verify if coordinates are valid in canva area.
   * @return array
   */
    public function areCoordinatesValid($x, $y) {
        if (empty($this->canvas)) {
            return false;
        }
    
        $canvasWidth = count($this->canvas[0]);
        $canvasHeight = count($this->canvas);
        
        return ($x >= 1 && $x <= $canvasWidth - 2 && $y >= 1 && $y <= $canvasHeight - 2);
    }
}
