<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 14:50
 */

namespace Mukadi\ChartJSBundle\Model;

use Mukadi\ChartJSBundle\Model\Manipulator\Condition;


interface WorkerInterface {

    /**
     * @return string
     */
    public function getQuery();
    /**
     * @return array
     */
    public function getParams();
    /**
     * @param string $key
     * @param mixed $value
     */
    public function putParam($key,$value);
    /**
     * @param string $entity
     * @param string $alias
     * @return WorkerInterface
     */
    public function setModel($entity,$alias);

    /**
     * @param string $property
     * @param string $alias
     * @return WorkerInterface
     */
    public function selector($property,$alias);
    /**
     * @param string $criteria
     * @param string $name
     * @return WorkerInterface
     */
    public function func($criteria, $name);
    /**
     * @param string $name
     * @return DataCruncherInterface
     */
    public function values($name);

    /**
     * @param string $selector
     * @param array $matches
     * @return DataCruncherInterface
     */
    public function matches($selector,array $matches);
    /**
     * @param string|array|DataCruncherInterface $labels
     * @return WorkerInterface
     */
    public function labels($labels);
    /**
     * @param string $property
     * @return WorkerInterface
     */
    public function groupBy($property);
    /**
     * @return Condition
     */
    public function conditions();
    /**
     * @param Condition $c
     * @return WorkerInterface
     */
    public function applyCondition(Condition $c);

    /**
     * @param mixed|array|DataCruncherInterface $value
     * @param string $label
     * @param array $options
     * @return WorkerInterface
     */
    public function dataset($value,$label,$options = array());

    /**
     * @param array $input
     * @return string
     */
    public function getLabel($input);
    /**
     * @return array
     */
    public function getValueKeys();

    /**
     * @param string $key
     * @param array $input
     * @return mixed
     */
    public function getData($key,$input);

    /**
     * @param string $key
     * @return array
     */
    public function getConfigs($key);
} 