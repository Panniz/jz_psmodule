<?php

use Panniz\JzPsmodule\ModuleInterface;
use Panniz\JzPsmodule\ModuleTrait;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class JZ_PsModule extends \Module implements ModuleInterface
{
    use ModuleTrait;
}