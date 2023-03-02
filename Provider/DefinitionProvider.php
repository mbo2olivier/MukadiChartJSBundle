<?php
namespace Mukadi\ChartJSBundle\Provider;

use Mukadi\Chart\ChartDefinitionInterface;
use Mukadi\Chart\DefinitionProviderInterface;

class DefinitionProvider implements DefinitionProviderInterface {

    private array $definitions;

    public function __construct()
    {
        $this->definitions = [];
    }

    public function addDefinition(ChartDefinitionInterface $d)
    {
        $this->definitions[get_class($d)] = $d;
    }

    public function provide(string $fcqn): ChartDefinitionInterface
    {
        return $this->definitions[$fcqn];
    }
}