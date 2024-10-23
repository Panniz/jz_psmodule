<?php

namespace Panniz\JzPsmodule\Install;

use Db;
use Panniz\JzPsmodule\ModuleInterface;

class Installer
{
    public static function install(ModuleInterface $module): bool
    {
        return
            (bool)$module->registerHook($module->getHooks()) &&
            self::executeQueries($module->getInstallQueries());
    }

    public static function uninstall(ModuleInterface $module): bool
    {
        return self::executeQueries($module->getUninstallQueries());
    }

    private static function executeQueries(array $queries): bool
    {
        foreach ($queries as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }

        return true;
    }
}
