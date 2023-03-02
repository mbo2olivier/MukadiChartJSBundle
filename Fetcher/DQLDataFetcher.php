<?php
namespace Mukadi\ChartJSBundle\Fetcher;

use Doctrine\ORM\EntityManagerInterface;
use Mukadi\Chart\DataFetcherInterface;

class DQLDataFetcher implements DataFetcherInterface {

    public function __construct(private EntityManagerInterface $em)
    {
        
    }
    
    public function execute(string $sql, array $vars = []): iterable
    {
        $q = $this->em->createQuery($sql);
        if (count($vars) > 0) {
            $q->setParameters($vars);
        }

        return $q->getResult();
    }
}