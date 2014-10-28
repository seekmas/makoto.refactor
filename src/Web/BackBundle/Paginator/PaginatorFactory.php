<?php

namespace Web\BackBundle\Paginator;

use Symfony\Component\DependencyInjection\Container;
use Knp\Component\Pager\Pagination\AbstractPagination;

/**
 * Class PaginatorFactory
 * @package Web\BackendBundle\Paginator
 */
class PaginatorFactory
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var string
     */
    private $entity_service;

    private $query;

    /**
     * @param Container $container
     * @param string $entity_service
     */
    public function __construct(Container $container , $entity_service = '')
    {
        $this->container = $container;
        $this->entity_service = $entity_service;

        $this->query = $this->container
            ->get($this->entity_service)
            ->createQueryBuilder('p')
            ->select('p');
    }

    public function orderBy($fieldName = 'id' , $asc = 'ASC')
    {
        $this->query
             ->orderBy('p.'.$fieldName , $asc);
        return $this;
    }

    public function where($where)
    {
        $flag = 0;
        foreach ($where as $key => $value) {
            if($flag)
            {
                $this->query->AndWhere('p.'.$key .'='. $value);
            }else
            {
                $this->query->where('p.'.$key .'='. $value);
            }
            $flag = 1;
        }

        return $this;
    }

    /**
     * @param int $pageNum
     * @return AbstractPagination
     */
    public function getPaginator($pageNum = 10)
    {

        $this->query->getQuery();
        $paginator = $this->container->get('knp_paginator');
        $pagination = $paginator->paginate(
            $this->query,
            $this->container->get('request')->query->get('page', 1)/*page number*/,
            $pageNum
        );

        return $pagination;
    }

}