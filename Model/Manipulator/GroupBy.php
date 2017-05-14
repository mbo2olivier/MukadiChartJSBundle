<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 14:46
 */

namespace Mukadi\ChartJSBundle\Model\Manipulator;


use Mukadi\ChartJSBundle\Model\QueryManipulatorInterface;

class GroupBy implements QueryManipulatorInterface{

    protected $criteria;

    public function __construct($criteria){
        $this->criteria = $criteria;
    }
    /**
     * @param string $dql
     * @return string
     */
    public function updateQuery($dql)
    {
        if(preg_match('#^GROUP BY#',$dql)){
            if(preg_match('#GROUP BY$#',$dql)){
                return $dql." ".$this->criteria;
            }else{
                return $dql.",".$this->criteria;
            }
        }else{
            return $dql." GROUP BY ".$this->criteria;
        }
    }
} 