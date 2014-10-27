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

    /**
     * @param Container $container
     * @param string $entity_service
     */
    public function __construct(Container $container , $entity_service = '')
    {
        $this->container = $container;
        $this->entity_service = $entity_service;
    }


    /**
     * @param int $pageNum
     * @return AbstractPagination
     */
    public function getPaginator($pageNum = 10)
    {
        $query = $this->container
            ->get($this->entity_service)
            ->createQueryBuilder('p')
            ->select('p')
            ->getQuery();

        $paginator = $this->container->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->container->get('request')->query->get('page', 1)/*page number*/,
            $pageNum
        );

        return $pagination;
    }

}