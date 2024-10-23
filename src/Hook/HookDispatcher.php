<?php

declare(strict_types=1);

namespace Panniz\JzPsmodule\Hook;

use Panniz\JzPsmodule\ModuleInterface;

class HookDispatcher
{
    protected HookProvider $hookProvider;

    public function __construct(HookProvider $hookProvider)
    {
        $this->hookProvider = $hookProvider;
    }

    /**
     * Find hook and dispatch it
     *
     * @param string $hookName
     * @param array $params
     *
     * @return mixed
     */
    public function dispatch(string $hookName, array $params = [])
    {
        $hookClassName = '\\' . __NAMESPACE__ . '\\Hooks\\' . ucfirst(preg_replace('~^hook~', '', $hookName));
        $hookObj = $this->hookProvider->getHook($hookClassName);

        if ($hookObj !== null) {
            return $hookObj->exec($params);
        }

        return;
    }
}
