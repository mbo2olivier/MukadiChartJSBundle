<?php
namespace Mukadi\ChartJSBundle\Factory;

use Doctrine\ORM\EntityManagerInterface;
use Mukadi\Chart\ChartFactoryInterface;
use Mukadi\ChartJSBundle\Fetcher\DQLDataFetcher;
use Mukadi\ChartJSBundle\Fetcher\NativeDataFetcher;
use Mukadi\ChartJSBundle\Provider\DefinitionProvider;

class ChartFactory {

    public function __construct(protected EntityManagerInterface $em, protected DefinitionProvider $provider)
    {
        
    }

    public function withNativeSql(): ChartFactoryInterface {
        return new BaseFactory(
            new NativeDataFetcher($this->em),
            $this->provider
        );
    }

    public function withDql(): ChartFactoryInterface {
        return new BaseFactory(
            new DQLDataFetcher($this->em),
            $this->provider
        );
    }
}