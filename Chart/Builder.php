<?php
/**
 * This file is part of the mukadi/chartjs-bundle
 * (c) 2018 Genius Conception
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Mukadi\ChartJSBundle\Chart;

use Mukadi\Chart\AbstractBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
/**
 * Class Builder.
 * 
 * @author Olivier M. Mukadi <olivier.m@geniusconception.com>
 */
class Builder extends AbstractBuilder
{
    /** @var EntityManagerInterface $em */
    protected $em;

    /** @var Query $q  */
    protected $q;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
        $this->q = null;
    }
    
    public function query($query) {
        $this->q = $this->em->createQuery($query);
        return $this;
    }

    public function setParameter($key, $value) {
        $this->q->setParameter($key, $value);
        return $this;
    }

    protected function getData() {
        return $this->q->getResult();
    }
}
