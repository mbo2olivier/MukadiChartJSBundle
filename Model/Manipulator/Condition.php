<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 14:55
 */

namespace Mukadi\ChartJSBundle\Model\Manipulator;

use Mukadi\ChartJSBundle\Model\WorkerInterface;
use Mukadi\ChartJSBundle\Model\QueryManipulatorInterface;

class Condition implements QueryManipulatorInterface{

    /**
     * @var array
     */
    protected $c;
    /**
     * @var string
     */
    protected $q;
    /**
     * @var string|null
     */
    protected $op;
    /**
     * @var WorkerInterface
     */
    protected $worker;

    public function __construct(WorkerInterface $worker){
        $this->c=array();
        $this->q="";
        $this->op = null;
        $this->worker = $worker;
    }
    /**
     * @param string $dql
     * @return string
     */
    public function updateQuery($dql)
    {
        if(preg_match('#^WHERE#',$dql)){
            if(preg_match('#WHERE$#',$dql)){
                return $dql.$this->q;
            }else{
                return $dql.",".$this->q;
            }
        }else{
            return $dql." WHERE".$this->q;
        }
    }

    /**
     * @param $condition
     * @param array $param
     * @return $this
     */
    public function set($condition,$param = array()){
        if(count($param) > 0 ){
            foreach($param as $key => $value){
                $this->worker->putParam($key,$value);
            }
        }
        if(!is_null($this->op)){
            $this->c[] = $condition;
        }else{
            $this->q .= " ".$condition;
        }
        return $this;
    }

    /**
     * @return Condition
     */
    public function _or(){
        $this->op = "OR";
        if(strlen($this->q)>0) $this->q .= " ".$this->op;
        return $this;
    }

    /**
     * @return Condition
     */
    public function _and(){
        $this->op = "AND";
        if(strlen($this->q)>0) $this->q .= " ".$this->op;
        return $this;
    }

    /**
     * @return Condition
     */
    public function end(){
        $i = 0;
        foreach($this->c as $cd){
            $this->q .= (($i > 0)? " ".$this->op." ":" ").$cd;
            $i++;
        }
        $this->c = array();
        $this->op = null;
        return $this;
    }

    /**
     * @return WorkerInterface
     */
    public function endConditions(){
        return $this->worker->applyCondition($this);
    }

    /**
     * @return string
     */
    public function getQ(){
        return $this->q;
    }
} 