<?php

namespace Panniz\JzPsmodule\Hook;

use Panniz\JzPsmodule\ModuleInterface;

abstract class AbstractHook implements HookInterface
{
    protected \Context $context;

    protected ModuleInterface $module;

    protected \Db $database;

    public function __construct(ModuleInterface $module)
    {
        $this->module = $module;
        $this->context = $module->getContext();
        $this->database = $module->getDatabase();
    }

    protected function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->module->getTranslator()->trans($id, $parameters, $domain, $locale);
    }

    protected function get(string $serviceName)
    {
        return $this->module->get($serviceName);
    }
}
