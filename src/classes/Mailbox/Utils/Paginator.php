<?php

namespace Mailbox\Utils;

class Paginator
{
    /**
     *
     * @var int
     */
    protected $itemsPerPage;
    
    /**
     *
     * @var \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected $queryBuilder;
    /**
     *
     * @var int
     */
    protected $total;
    /**
     *
     * @var int
     */
    protected $totalPages;

    public function __construct(int $itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
        $this->total = null;
        $this->totalPages = null;
    }
    
    public function setQueryBuilder(\Doctrine\ODM\MongoDB\Query\Builder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        return $this;
    }
    
    public function getItems(int $page)
    {
        if (!$this->queryBuilder instanceof \Doctrine\ODM\MongoDB\Query\Builder) {
            throw new \LogicException('setQueryBuilder method should be called first');
        }
        
        $result = [];
        $result['page'] = $page;
        $result['totalPages'] = $this->getTotalPages();

        if ($page <= 0 || $page > $this->getTotalPages()) {
            return $result;
        }
        
        $skipItems = ($page - 1) * $this->itemsPerPage;
        $items = $this->queryBuilder
                ->skip($skipItems)
                ->limit($this->itemsPerPage)
                ->getQuery()
                ->execute();
        
        $result['items'] = $items->toArray();
        
        return $result;
    }
    
    public function getTotalPages()
    {
        if ($this->totalPages === null){
            $this->totalPages = ceil($this->getTotal() / $this->itemsPerPage);
        }
        
        return $this->totalPages;
    }
    
    public function getTotal()
    {
        if ($this->total === null){
            $this->total = $this->queryBuilder->getQuery()->execute()->count();
        }
        
        return $this->total;
    }
}