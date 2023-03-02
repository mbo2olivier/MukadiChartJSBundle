<?php
namespace Mukadi\ChartJSBundle\Factory;

use Mukadi\Chart\DataFetcherInterface;
use Mukadi\Chart\DefinitionProviderInterface;
use Mukadi\Chart\Factory\AbstractChartFactory;

class BaseFactory extends AbstractChartFactory {

    public function __construct(private DataFetcherInterface $fetcher, DefinitionProviderInterface $provider)
    {
        parent::__construct($provider);
    }

    public function getDataFetcher(): DataFetcherInterface
    {
        return $this->fetcher;
    }
}