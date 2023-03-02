<?php
namespace Mukadi\ChartJSBundle\DependencyInjection\Compiler;

use Mukadi\ChartJSBundle\Provider\DefinitionProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DefinitionPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container)
    {
        if (!$container->has(DefinitionProvider::class)) {
            return;
        }

        $provider = $container->findDefinition(DefinitionProvider::class);

        $definitions = $container->findTaggedServiceIds('mukadi.chart.chart_definition');

        foreach ($definitions as $id => $definition) {
            $provider->addMethodCall('addDefinition', [new Reference($id)]);
        }
    }
}