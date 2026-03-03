<?php

namespace Eden\R606Eval\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
#[Table(name: 'db_table')]
class DbTable
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue()]
    private $id;
    #[Column(length: 140)]
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
