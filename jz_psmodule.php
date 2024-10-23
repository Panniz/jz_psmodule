<?php

use Panniz\JzPsmodule\AbstractModule;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

class JZ_PsModule extends AbstractModule
{
    public function __construct()
    {
        $this->name = 'jz_psmodule';
        $this->version = '1.0.0';
        $this->author = 'Jacopo Zane';
        $this->ps_versions_compliancy = array('min' => '8.0.0', 'max' => _PS_VERSION_);
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('JZ PSModule', [], 'Modules.Jzpsmodule.Admin');
        $this->description = $this->trans('Description of my module.', [], 'Modules.Jzpsmodule.Admin');

        $this->confirmUninstall = $this->trans('Are you sure you want to uninstall?', [], 'Modules.Jzpsmodule.Admin');
    }
}