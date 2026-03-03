<?php

namespace Eden\R606Eval\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Eden\R606Eval\Entity\DbTable;

class DbTableFixture implements FixtureInterface
{
    private const DATA = ["azerty", "qabcdefh", "xyz", "123456789"];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $text) {
            $entry = new DbTable();
            $entry->setText($text);
            $manager->persist($entry);
        }

        $manager->flush();
    }
}
