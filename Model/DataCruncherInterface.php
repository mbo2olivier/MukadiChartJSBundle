<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 14:32
 */

namespace Mukadi\ChartJSBundle\Model;

/**
 * Interface DataCruncherInterface
 * @package Mukadi\ChartJSBundle\Model
 */
interface DataCruncherInterface {

    /**
     * @param array $input
     * @return mixed
     */
    public function getData($input);
} 