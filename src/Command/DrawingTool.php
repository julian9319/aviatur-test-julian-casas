<?php declare(strict_types = 1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\String\Exception\InvalidArgumentException;
use App\Command\CommandFactory;
use App\Command\DrawCanvasSingleton;

#[AsCommand(
    name: 'app:draw-tool',
    description: 'Implement canva tool.',
    hidden: false,
    aliases: ['app:drawtool']
)]
class DrawingTool extends Command {

    private $canvas;
    private $commandFactory;
    private $canvasType=[];
    private $inputFile;
    private $outputFile;

    protected static $defaultDescription = 'Implement canva tool.';
    public function __construct() {
        parent::__construct();

        $this->canvasType=[
            'C'=>'Canvas',
            'L'=>'Line',
            'R'=>'Rectangle',
            'B'=>'FillBucket',
        ];

  
        $this->inputFile='/var/www/aviatur/var/input.txt';
        $this->outputFile='/var/www/aviatur/var/output.txt';
    }
    protected function configure(): void {
        $this->setHelp('This command is an implementation of canva tool to render canva, line, rectangle, and fill bucket.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        try {    
            $commands = file($this->inputFile, FILE_IGNORE_NEW_LINES);
            foreach ($commands as $command) {
                $params=$this->getParamas($command);
            
                file_put_contents($this->outputFile, $this->canvas->getCanvasAsString() . PHP_EOL, FILE_APPEND);
            }
            $output->section()->writeln('The command terminated correctly. The output file was generated.');
            $status=Command::SUCCESS;
        } catch (\Exception $e) {
            $output->section()->writeln('********** '.$e->getMessage().'********** ');
            $status=Command::FAILURE;
        }
        return $status;
    }

    private function drawElement($command): void {
        $params = $this->getParamas($command);
        if (isset($this->canvasType[strtoupper($params[0])])) {

        } else {
            throw new \Exception ('Command option not found.');
        }
    }
    
    private function getParamas(string $command): array {
        return explode(" ", $command);
    }
}
