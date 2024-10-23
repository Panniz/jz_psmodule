<?php
namespace Panniz\JzPsmodule\Hook;

use Panniz\JzPsmodule\ModuleInterface;

class HookProvider
{
    private ModuleInterface $module;
    private array $hooks;

    public function __construct(array $hooksNames)
    {
        foreach($hooksNames as $hookName) {
            $this->addHook($hookName);
        }
    }
    public function getHook(string $hookName): ?HookInterface
    {
        if(isset($this->hooks[$hookName])) {
            return new $hookName($this->module);
        }

        return null;
    }

    public function addHook(string $hookClassName): self
    {
        if(!\class_exists($hookClassName) || !\class_implements($hookClassName, HookInterface::class)) {
            throw new \InvalidArgumentException('Hook must implement HookInterface');
        }

        $reflection = new \ReflectionClass($hookClassName);

        $this->hooks[$reflection->getShortName()] = $hookClassName;

        return $this;
    }
}