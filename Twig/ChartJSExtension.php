<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 16:22
 */

namespace Mukadi\ChartJSBundle\Twig;

use Mukadi\Chart\ChartView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ChartJSExtension extends AbstractExtension {

    public function getFunctions(): array {
        return array(
            new TwigFunction('mukadi_chart',array($this, 'render'), array('is_safe' => array('html'))),
        );
    }

    public function render(ChartView $chart){
        return (string) $chart;
    }

    public function getName()
    {
        return "mukadi_chart_js";
    }
} 