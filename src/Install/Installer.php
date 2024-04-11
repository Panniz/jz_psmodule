<?php

namespace Panniz\JzPsmodule\Install;

use Db;
use Panniz\JzPsmodule\ModuleInterface;

class Installer
{
    protected const QUERIES = [];

    protected const UNINSTALL_QUERIES = [];

    public static function install(ModuleInterface $module): bool
    {
        return
            (bool)$module->registerHook($module->getHooks()) &&
            self::installDatabase();
    }

    public static function uninstall(): bool
    {
        return self::uninstallDatabase();
    }

    private static function installDatabase(): bool
    {
        return self::executeQueries(static::QUERIES);
    }

    private static function uninstallDatabase(): bool
    {
        return self::executeQueries(static::UNINSTALL_QUERIES);
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
