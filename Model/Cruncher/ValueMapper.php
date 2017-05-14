<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 15:04
 */

namespace Mukadi\ChartJSBundle\Model\Cruncher;


use Mukadi\ChartJSBundle\Model\DataCruncherInterface;
use Mukadi\ChartJSBundle\Model\Manipulator\ValueSelector;
use Mukadi\ChartJSBundle\Model\QueryManipulatorInterface;

class ValueMapper extends ValueSelector implements DataCruncherInterface{
    /**
     * @var string
     */
    protected $selector;
    /**
     * @var string
     */
    protected $alias;

    /**
     * @param array $input
     * @return mixed
     */
    public function getData($input)
    {
        if(! isset($input[$this->alias])) return null;
        else return $input[$this->alias];
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
} 