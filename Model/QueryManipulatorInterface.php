<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 14:37
 */

namespace Mukadi\ChartJSBundle\Model;


interface QueryManipulatorInterface {

    /**
     * @param string $dql
     * @return string
     */
    public function updateQuery($dql);
} 