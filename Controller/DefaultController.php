<?php

namespace Mukadi\ChartJSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MukadiChartJSBundle:Default:index.html.twig');
    }
}
