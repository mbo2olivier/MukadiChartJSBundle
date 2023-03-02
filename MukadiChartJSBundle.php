<?php

namespace Mukadi\ChartJSBundle;

use Mukadi\ChartJSBundle\DependencyInjection\Compiler\DefinitionPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MukadiChartJSBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DefinitionPass());
    }
}
