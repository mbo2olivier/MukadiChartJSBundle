<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 31/05/2017
 * Time: 17:30
 */

namespace Mukadi\ChartJSBundle\Model\Manipulator;


use Mukadi\ChartJSBundle\Model\QueryManipulatorInterface;

class ModelJoiner implements QueryManipulatorInterface{

    protected $property;
    protected $alias;

    function __construct($property, $alias)
    {
        $this->alias = $alias;
        $this->property = $property;
    }

    /**
     * @param string $dql
     * @return string
     */
    public function updateQuery($dql)
    {
        return " JOIN ".$this->property." AS ".$this->alias;
    }
} 