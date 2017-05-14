<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 14/05/2017
 * Time: 15:12
 */

namespace Mukadi\ChartJSBundle\Model;


use Doctrine\ORM\EntityManagerInterface;

abstract class ChartBuilder {
    /**
     * @var WorkerInterface
     */
    protected $worker;
    /**
     * @var EntityManagerInterface
     */
    protected  $em;
    /**
     * @var array
     */
    protected $labels;
    /**
     * @var array
     */
    protected $datasets;

    public function __construct(EntityManagerInterface $em,WorkerInterface $worker){
        $this->em = $em;
        $this->worker = $worker;
        $this->labels = array();
        $this->datasets = array();
    }

    /**
     * @param WorkerInterface $wk;
     */
    public abstract function factory(WorkerInterface $wk);

    private function computeData(){
        $this->factory($this->worker);
        $q = $this->em->createQuery($this->worker->getQuery());
        $params = $this->worker->getParams();
        foreach($params as $key => $value){
            $q->setParameter($key,$value);
        }
        $result = $q->getResult();
        $keys = $this->worker->getValueKeys();
        foreach($result as $input){
            $this->labels[] = $this->worker->getLabel($input);
            foreach($keys as $k){
                $dataset = (isset($this->datasets[$k]))? $this->datasets[$k]: array();
                $dataset['data'][] = $this->worker->getData($k,$input);
                $dataset['label'] =  $this->worker->getConfigs($k)['label'];
                $dataset = array_merge($dataset,$this->worker->getConfigs($k)['options']);
                $this->datasets[$k] = $dataset;
            }
        }
    }

    /**
     * @param string $id
     * @param null|string $type
     * @param null|array $options
     * @return Chart
     */
    public function buildChart($id,$type=null,$options=null){
        $this->computeData();
        $c = new Chart($id);
        $c->setLabels($this->labels);
        $c->setDatasets(array_values($this->datasets));
        if(!is_null($type)) $c->setType($type);
        if(is_array($options)) $c->pushOptions($options);
        return $c;
    }

} 