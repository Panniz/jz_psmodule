<?php
namespace Panniz\JzPsmodule;

use Panniz\JzPsmodule\Hook\HookDispatcher;
use Panniz\JzPsmodule\Install\Installer;

trait ModuleTrait
{
    protected \Db $db;

    protected array $hooks = [];

    protected HookDispatcher $hookDispatcher;

    public function install(): bool
    {
        return parent::install() && Installer::install($this);
    }

    public function uninstall(): bool
    {
        return parent::uninstall() && Installer::uninstall($this);
    }

    public function getContext(): \Context
    {
        return $this->context;
    }

    public function getDatabase(): \Db
    {
        return $this->db;
    }

    public function getHooks(): array
    {
        return $this->hooks;
    }

    public function getHookDispatcher(): HookDispatcher
    {
        if(!isset($this->hookDispatcher)){
            $this->hookDispatcher = new HookDispatcher($this);
        }
        return $this->hookDispatcher;
    }

    public function __call($methodName, $arguments)
    {
        return $this->getHookDispatcher()->dispatch(
            $methodName,
            !empty($arguments[0]) ? (is_array($arguments[0]) ? $arguments[0] : [$arguments[0]]) : []
        );
    }

    public function isUsingNewTranslationSystem(): bool
    {
        return true;
    }
}
