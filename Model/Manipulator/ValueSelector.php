<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 18:16
 */

namespace Mukadi\ChartJSBundle\Model\Manipulator;


use Mukadi\ChartJSBundle\Model\QueryManipulatorInterface;

class ValueSelector implements QueryManipulatorInterface{

    /**
     * @var string
     */
    protected $selector;
    /**
     * @var string
     */
    protected $alias;

    function __construct($selector, $alias)
    {
        $this->selector = $selector;
        $this->alias = $alias;
    }

    /**
     * @param string $dql
     * @return string
     */
    public function updateQuery($dql)
    {
        $qp = $this->selector." AS ".$this->alias;
        if(preg_match('#^SELECT#',$dql)){
            if(preg_match('#SELECT$#',$dql)){
                return $dql." ".$qp;
            }else{
                return $dql.",".$qp;
            }
        }else{
            return $dql." SELECT ".$qp;
        }
    }


} 