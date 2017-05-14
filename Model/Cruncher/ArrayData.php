<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 15:07
 */

namespace Mukadi\ChartJSBundle\Model\Cruncher;


use Mukadi\ChartJSBundle\Model\DataCruncherInterface;

class ArrayData implements DataCruncherInterface{

    /**
     * @var array
     */
    protected $data;
    /**
     * @var integer
     */
    protected $i;

    /**
     * @param array $data
     */
    public function __construct(array $data){
        $this->data = $data;
        $this->i = 0;
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function getData($input)
    {
        if($this->i < count($this->data)){
            $v = $this->data[$this->i];
            $this->i++;
            return $v;
        }
        return null;
    }
} 