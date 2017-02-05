<?php

namespace Mailbox\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class MainController
{
    /* @var $dm \Doctrine\ODM\MongoDB\DocumentManager */
    protected $dm;
    
    /* @var $paginator \Mailbox\Utils\Paginator */
    protected $paginator;

    public function __construct(\Doctrine\ODM\MongoDB\DocumentManager $dm, \Mailbox\Utils\Paginator $paginator)
    {
        $this->dm = $dm;
        $this->paginator = $paginator;
    }
    
    public function listAction($page)
    {
        $queryBuilder = $this->dm->getRepository('Mailbox\Documents\Item')
            ->createQueryBuilder();
        
        $this->paginator->setQueryBuilder($queryBuilder);
        $result = $this->paginator->getItems($page);

        return new JsonResponse($result);
    }
    
    public function listArchivedAction($page)
    {
        $queryBuilder = $this->dm->getRepository('Mailbox\Documents\Item')
            ->getArchivedQueryBuilder();
        
        $this->paginator->setQueryBuilder($queryBuilder);
        $result = $this->paginator->getItems($page);

        return new JsonResponse($result);
    }
    
    public function showAction($uid)
    {
        $result = $this->dm->getRepository('Mailbox\Documents\Item')
            ->findOneByUid($uid);
        
        return new JsonResponse($result);
    }
    
    public function readAction($uid)
    {
        $result = $this->dm->getRepository('Mailbox\Documents\Item')->read($uid);
        
        return new JsonResponse($result);
    }
    
    public function archiveAction($uid)
    {
        $result = $this->dm->getRepository('Mailbox\Documents\Item')->archive($uid);
        
        return new JsonResponse($result);
    }
}