<?php

declare(strict_types=1);

namespace Panniz\JzPsmodule\Hook;

use Panniz\JzPsmodule\ModuleInterface;

class HookDispatcher
{
    protected array $availableHooks = [];

    protected ModuleInterface $module;

    public function __construct(ModuleInterface $module)
    {
        $this->module = $module;
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

        if (\class_exists($hookClassName) && is_subclass_of($hookClassName, AbstractHook::class)) {
            /**
             * @var \Fincons\Qaplaorders\Hooks\HookInterface
             */
            $hookObj = new $hookClassName($this->module);
            return $hookObj->exec($params);
        }

        return;
    }
}
