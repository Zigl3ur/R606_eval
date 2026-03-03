<?php

declare(strict_types=1);

namespace Eden\R606Eval\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260303083259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create db_table table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('db_table');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('text', 'string', ['length' => 140]);
        $table->addColumn('createdAt', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('db_table');
    }
}
