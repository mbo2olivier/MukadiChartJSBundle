<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 16:31
 */

namespace Mukadi\ChartJSBundle\Model;


use Doctrine\ORM\EntityManagerInterface;
use Mukadi\ChartJSBundle\Model\Manipulator\Condition;

class SimpleChartBuilder extends ChartBuilder implements WorkerInterface{

    public function __construct(EntityManagerInterface $em){
        parent::__construct($em,new Worker());
    }
    /**
     * @param WorkerInterface $wk ;
     */
    public function factory(WorkerInterface $wk){}

    /**
     * @return string
     */
    public function getQuery(){
        return $this->worker->getQuery();
    }

    /**
     * @return array
     */
    public function getParams(){
        $this->worker->getParams();
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function putParam($key, $value){
        return $this->worker->putParam($key,$value);
    }

    /**
     * @param string $entity
     * @param string $alias
     * @return WorkerInterface
     */
    public function setModel($entity, $alias)
    {
        $this->worker->setModel($entity,$alias);
        return $this;
    }

    /**
     * @param string $property
     * @param string $alias
     * @return WorkerInterface
     */
    public function selector($property, $alias)
    {
        $this->worker->selector($property,$alias);
        return $this;
    }


    /**
     * @param string $criteria
     * @param string $name
     * @return WorkerInterface
     */
    public function func($criteria, $name)
    {
        $this->worker->func($criteria,$name);
        return $this;
    }

    /**
     * @param string $name
     * @return DataCruncherInterface
     */
    public function values($name)
    {
        return $this->worker->values($name);
    }

    /**
     * @param string $selector
     * @param array $matches
     * @return DataCruncherInterface
     */
    public function matches($selector, array $matches)
    {
        return $this->worker->matches($selector,$matches);
    }


    /**
     * @param array|DataCruncherInterface $labels
     * @return WorkerInterface
     */
    public function labels($labels)
    {
        $this->worker->labels($labels);
        return $this;
    }

    /**
     * @param string $property
     * @return WorkerInterface
     */
    public function groupBy($property)
    {
        $this->worker->groupBy($property);
        return $this;
    }

    /**
     * @return Condition
     */
    public function conditions()
    {
        return $this->worker->conditions();
    }

    /**
     * @param Condition $c
     * @return WorkerInterface
     */
    public function applyCondition(Condition $c)
    {
        $this->worker->applyCondition($c);
        return $this;
    }

    /**
     * @param mixed|array|DataCruncherInterface $value
     * @param string $label
     * @param array $options
     * @return WorkerInterface
     */
    public function dataset($value, $label, $options = array())
    {
        $this->worker->dataset($value,$label,$options);
        return $this;
    }

    /**
     * @param array $input
     * @return string
     */
    public function getLabel($input)
    {
        return $this->worker->getLabel($input);
    }

    /**
     * @return array
     */
    public function getValueKeys()
    {
        return $this->worker->getValueKeys();
    }

    /**
     * @param string $key
     * @param array $input
     * @return mixed
     */
    public function getData($key, $input)
    {
        return $this->worker->getData($key,$input);
    }

    /**
     * @param string $key
     * @return array
     */
    public function getConfigs($key)
    {
        return $this->worker->getConfigs($key);
    }


} 