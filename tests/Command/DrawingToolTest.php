<?php

namespace App\Tests\Command;

use App\Command\DrawingTool;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\UtilService;

class DrawingToolTest extends KernelTestCase
{

    public function testExecute(): void {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $input = $this->createMock(InputInterface::class);
        $output = $this->createMock(OutputInterface::class);
        
        $command = $application->find('app:drawtool');
        $commandTester = new CommandTester($command);
        $commandTester->execute([], [$input, $output]);

        $commandTester->assertCommandIsSuccessful();
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('file was generated', $output, 'Command execution failed.') ; 

    }   
}
