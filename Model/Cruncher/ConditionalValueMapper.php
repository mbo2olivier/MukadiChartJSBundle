<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 17:47
 */

namespace Mukadi\ChartJSBundle\Model\Cruncher;


use Mukadi\ChartJSBundle\Model\DataCruncherInterface;

class ConditionalValueMapper implements DataCruncherInterface{
    /**
     * @var array
     */
    protected $matches;
    /**
     * @var string
     */
    protected $selector;

    /**
     * @param string $selector
     * @param array $matches
     */
    function __construct($selector,array $matches)
    {
        $this->selector = $selector;
        $this->matches = $matches;
    }

    public function getData($input)
    {
        if(! isset($input[$this->selector])) return null;
        else{
            foreach ($this->matches as $key => $val){
                if(!isset($input[$key]) || $input[$key] != $val){
                    return null;
                }
            }
            return $input[$this->selector];
        }
    }


}