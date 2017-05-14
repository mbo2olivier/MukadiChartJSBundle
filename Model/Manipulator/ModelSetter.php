<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 14:42
 */

namespace Mukadi\ChartJSBundle\Model\Manipulator;


use Mukadi\ChartJSBundle\Model\QueryManipulatorInterface;

class ModelSetter implements QueryManipulatorInterface{

    protected $model;
    protected $alias;

    public function __construct($model,$alias){
        $this->model = $model;
        $this->alias = $alias;
    }
    /**
     * @param string $dql
     * @return string
     */
    public function updateQuery($dql)
    {
        return " FROM ".$this->model." AS ".$this->alias;
    }


} 