<?php

namespace AntiCorruptionLayer\Upstream;

use AntiCorruptionLayer\Dependencies\DependenciesProvider;
use AntiCorruptionLayer\Upstream\Providers\HandlersProvider;
use CrossCutting\DataManagement\Collection\Collection;
use CrossCutting\DataManagement\Collection\DefaultIterator;
use CrossCutting\DataManagement\Collection\Items;

class ChainHandler
{

    private $incomeData;

    /**
     * @var Items
     */
    private $handlers;

    /**
     * @var UpstreamHandler
     */
    private $chain;

    public function __construct(array $incomeData)
    {

        $this->incomeData = $incomeData;
        $this->statements();
        $this->apply();

    }

    private function statements(): void
    {
        $dependencies = new DependenciesProvider($this->incomeData);
        $handlersEnum = new HandlersProvider($dependencies, new Collection());
        $this->handlers = $handlersEnum->handlers();

    }

    private function apply(): void
    {

        $this->chain = null;
        $handlers = new DefaultIterator($this->handlers->getItems());
        $handlers->rewind();

        while ($handlers->valid()) {

            $handler = $handlers->current();
            $handlers->next();

            if (empty($handler['class'])) {
                throw new \OutOfBoundsException('Class required');
            }

            $handlerClass = new \ReflectionClass($handler['class']);

            if (empty($handler['dependencies'])) {
                $this->applyHandler($handlerClass);
                continue;
            }

            $this->applyHandlerWithDependencies($handlerClass, $handler['dependencies']);
        }

    }

    private function applyHandler(\ReflectionClass $handlerClass): void
    {
        $arguments = [$this->chain];
        $this->chain = $handlerClass->newInstanceArgs($arguments);
    }

    private function applyHandlerWithDependencies(\ReflectionClass $handlerClass, array $dependencies): void
    {
        array_unshift($dependencies, $this->chain);
        $this->chain = $handlerClass->newInstanceArgs($dependencies);
    }

    public function chain(): UpstreamHandler
    {
        return $this->chain;
    }

}