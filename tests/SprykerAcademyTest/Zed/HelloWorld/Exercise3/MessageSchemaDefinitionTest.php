<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\HelloWorld\Exercise3;

use Codeception\Test\Unit;

/**
 * Exercise 3: Message Table Schema
 *
 * Verifies that students defined the pyz_message table with the correct
 * columns, primary key, auto-increment, and unique constraint.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/HelloWorld/ Exercise3
 */
class MessageSchemaDefinitionTest extends Unit
{
    private const SCHEMA_XML_RELATIVE_PATH = 'src/SprykerAcademy/Zed/HelloWorld/Persistence/Propel/Schema/pyz_message.schema.xml';

    private function findSchemaXmlPath(): string
    {
        $dir = dirname(__DIR__, 5);
        $candidate = $dir . '/' . self::SCHEMA_XML_RELATIVE_PATH;

        if (file_exists($candidate)) {
            return $candidate;
        }

        $cwd = getcwd();
        $candidate = $cwd . '/' . self::SCHEMA_XML_RELATIVE_PATH;

        if (file_exists($candidate)) {
            return $candidate;
        }

        $this->fail(
            'Cannot find pyz_message.schema.xml. Expected at: ' . self::SCHEMA_XML_RELATIVE_PATH,
        );
    }

    private function loadSchemaXml(): \SimpleXMLElement
    {
        $path = $this->findSchemaXmlPath();
        $xml = simplexml_load_file($path);
        $this->assertNotFalse($xml, 'Failed to parse pyz_message.schema.xml.');

        return $xml;
    }

    private function getTable(): \SimpleXMLElement
    {
        $xml = $this->loadSchemaXml();
        $tables = $xml->xpath('//table[@name="pyz_message"]');

        $this->assertNotEmpty(
            $tables,
            'Schema must contain a <table name="pyz_message"> element.',
        );

        return $tables[0];
    }

    public function testSchemaXmlFileExists(): void
    {
        $this->findSchemaXmlPath();
        $this->assertTrue(true);
    }

    public function testTableNameIsPyzMessage(): void
    {
        $this->getTable();
        $this->assertTrue(true);
    }

    public function testIdMessageColumnExists(): void
    {
        $table = $this->getTable();
        $columns = $table->xpath('column[@name="id_message"]');

        $this->assertNotEmpty(
            $columns,
            'Table pyz_message must have a column named "id_message".',
        );
    }

    public function testIdMessageIsPrimaryKey(): void
    {
        $table = $this->getTable();
        $columns = $table->xpath('column[@name="id_message"]');

        if (empty($columns)) {
            $this->markTestSkipped('Column id_message does not exist yet.');
        }

        $column = $columns[0];
        $this->assertSame(
            'true',
            (string)$column['primaryKey'],
            'Column id_message must have primaryKey="true".',
        );
    }

    public function testIdMessageIsAutoIncrement(): void
    {
        $table = $this->getTable();
        $columns = $table->xpath('column[@name="id_message"]');

        if (empty($columns)) {
            $this->markTestSkipped('Column id_message does not exist yet.');
        }

        $column = $columns[0];
        $this->assertSame(
            'true',
            (string)$column['autoIncrement'],
            'Column id_message must have autoIncrement="true".',
        );
    }

    public function testIdMessageIsInteger(): void
    {
        $table = $this->getTable();
        $columns = $table->xpath('column[@name="id_message"]');

        if (empty($columns)) {
            $this->markTestSkipped('Column id_message does not exist yet.');
        }

        $column = $columns[0];
        $this->assertSame(
            'INTEGER',
            (string)$column['type'],
            'Column id_message must be of type INTEGER.',
        );
    }

    public function testMessageColumnExists(): void
    {
        $table = $this->getTable();
        $columns = $table->xpath('column[@name="message"]');

        $this->assertNotEmpty(
            $columns,
            'Table pyz_message must have a column named "message".',
        );
    }

    public function testMessageColumnIsVarchar255(): void
    {
        $table = $this->getTable();
        $columns = $table->xpath('column[@name="message"]');

        if (empty($columns)) {
            $this->markTestSkipped('Column message does not exist yet.');
        }

        $column = $columns[0];
        $this->assertSame(
            'VARCHAR',
            (string)$column['type'],
            'Column message must be of type VARCHAR.',
        );
        $this->assertSame(
            '255',
            (string)$column['size'],
            'Column message must have size="255".',
        );
    }

    public function testMessageColumnHasUniqueConstraint(): void
    {
        $table = $this->getTable();
        $uniqueColumns = $table->xpath('unique/unique-column[@name="message"]');

        $this->assertNotEmpty(
            $uniqueColumns,
            'Column message must have a unique constraint.',
        );
    }
}
