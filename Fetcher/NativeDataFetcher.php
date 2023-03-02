<?php
namespace Mukadi\ChartJSBundle\Fetcher;

use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;
use Mukadi\Chart\DataFetcherInterface;

class NativeDataFetcher implements DataFetcherInterface {

    public function __construct(private EntityManagerInterface $em)
    {
        
    }

    public function execute(string $sql, array $vars = []): iterable
    {
        if (count($vars) > 0) {
            $stmt = $this->em->getConnection()->prepare($sql);
            foreach($vars as $key => $val) {
                $type = ParameterType::STRING;

                if (is_integer($val))
                    $type = ParameterType::INTEGER;
                else if (is_bool($val))
                    $type = ParameterType::BOOLEAN;
                else if (is_null($val))
                    $type = ParameterType::NULL;

                $stmt->bindValue($key, $val, $type);
            }
            $res = $stmt->executeQuery();
            return $res->fetchAllAssociative();
        }
        $stmt = $this->em->getConnection()->executeQuery($sql, $vars);
        return $stmt->fetchAllAssociative();
    }
}