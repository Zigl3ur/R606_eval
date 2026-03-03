<?php

require_once __DIR__ . '/../../bootstrap.php';

use Doctrine\ORM\EntityRepository;

class DbTableRepository extends EntityRepository
{
    public function findAll(): array
    {
        return parent::findAll();
    }
}
