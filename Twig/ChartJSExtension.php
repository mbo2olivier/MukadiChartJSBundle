<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 16:22
 */

namespace Mukadi\ChartJSBundle\Twig;


use Mukadi\ChartJSBundle\Model\Chart;

class ChartJSExtension extends \Twig_Extension {
    /**
     * @var \Twig_Environment
     */
    protected $templating;

    public function __construct(\Twig_Environment $templating){
        $this->templating = $templating;
    }

    public function getFunctions(){
        return array(
            new \Twig_SimpleFunction('mukadi_chart',array($this, 'render'), array('is_safe' => array('html'))),
        );
    }

    public function render(Chart $chart){
        return $this->templating->render('MukadiChartJSBundle::chart_container.html.twig',array(
            "id" => $chart->getId(),
            "type" => $chart->getType(),
            "labels" => json_encode($chart->getLabels()),
            "options" => json_encode($chart->getOptions()),
            "datasets" => json_encode($chart->getDatasets()),
        ));
    }

    public function getName()
    {
        return "mukadi_chart_js";
    }
} 