<?php

namespace App\Service;

use App\Command\DrawCanvasSingleton;

class UtilService
{
    public function getCanvasInstance(array $params): DrawCanvasSingleton {
        return DrawCanvasSingleton::getInstance((int)$params['1'], (int)$params['2']);
    }
}