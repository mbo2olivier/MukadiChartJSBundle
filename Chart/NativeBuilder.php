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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\DBAL\Connection;

/**
 * Class Builder.
 * 
 * @author Olivier M. Mukadi <olivier.m@geniusconception.com>
 */
class NativeBuilder extends AbstractBuilder
{
    /** @var Connection $connection */
    protected $connection;

   /** @var array $vars  */
   protected $vars;

   /** @var string $query  */
   protected $q;

    public function __construct(EntityManager $em) {
        $this->connection = $em->getConnection();
        $this->vars = [];
        $this->q = null;
    }
    
    public function query($query) {
        $this->q = $query;
        return $this;
    }

    public function setParameter($key, $value) {
        $this->vars[$key] = $value;
        return $this;
    }

    protected function getData() {
        $stmt = $this->connection->executeQuery($this->q, $this->vars);
        return $stmt->fetchAll();
    }
}
