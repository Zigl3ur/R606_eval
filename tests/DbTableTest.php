<?php

namespace Eden\R606Eval\Tests;

use Eden\R606Eval\Entity\DbTable;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the DbTable entity.
 * No database connection required.
 */
class DbTableTest extends TestCase
{
    public function testNewEntityHasNullId(): void
    {
        $entity = new DbTable();

        $this->assertNull($entity->getId());
    }

    public function testNewEntityHasNullText(): void
    {
        $entity = new DbTable();

        $this->assertNull($entity->getText());
    }

    public function testSetTextStoresValue(): void
    {
        $entity = new DbTable();
        $result = $entity->setText('hello');

        $this->assertSame('hello', $entity->getText());
    }

    public function testSetTextReturnsSelf(): void
    {
        $entity = new DbTable();
        $result = $entity->setText('fluent');

        $this->assertSame($entity, $result, 'setText() should return $this for fluent interface.');
    }
}
