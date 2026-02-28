<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\HelloWorld\Exercise2;

use Codeception\Test\Unit;

/**
 * Exercise 2: Data Transfer Object
 *
 * Verifies that students defined a Message transfer with the correct
 * properties in helloworld.transfer.xml.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/HelloWorld/ Exercise2
 */
class MessageTransferDefinitionTest extends Unit
{
    private const TRANSFER_XML_RELATIVE_PATH = 'src/SprykerAcademy/Shared/HelloWorld/Transfer/helloworld.transfer.xml';

    private function findTransferXmlPath(): string
    {
        // Walk up from this test file to find the project root (where src/ lives)
        $dir = dirname(__DIR__, 5); // tests/SprykerAcademyTest/Zed/HelloWorld/Exercise2 -> project root
        $candidate = $dir . '/' . self::TRANSFER_XML_RELATIVE_PATH;

        if (file_exists($candidate)) {
            return $candidate;
        }

        // Try from the working directory
        $cwd = getcwd();
        $candidate = $cwd . '/' . self::TRANSFER_XML_RELATIVE_PATH;

        if (file_exists($candidate)) {
            return $candidate;
        }

        $this->fail(
            'Cannot find helloworld.transfer.xml. Expected at: ' . self::TRANSFER_XML_RELATIVE_PATH,
        );
    }

    private function loadTransferXml(): \SimpleXMLElement
    {
        $path = $this->findTransferXmlPath();
        $xml = simplexml_load_file($path);
        $this->assertNotFalse($xml, 'Failed to parse helloworld.transfer.xml.');

        return $xml;
    }

    public function testTransferXmlFileExists(): void
    {
        $this->findTransferXmlPath();
        $this->assertTrue(true);
    }

    public function testMessageTransferIsDefined(): void
    {
        $xml = $this->loadTransferXml();
        $xml->registerXPathNamespace('t', 'spryker:transfer-01');

        $transfers = $xml->xpath('//t:transfer[@name="Message"]');

        if (empty($transfers)) {
            // Try without namespace (some students may omit it)
            $transfers = $xml->xpath('//transfer[@name="Message"]');
        }

        $this->assertNotEmpty(
            $transfers,
            'A <transfer name="Message"> definition is missing in helloworld.transfer.xml.',
        );
    }

    public function testMessageTransferHasIdMessageProperty(): void
    {
        $xml = $this->loadTransferXml();
        $xml->registerXPathNamespace('t', 'spryker:transfer-01');

        $properties = $xml->xpath('//t:transfer[@name="Message"]/t:property[@name="idMessage"]');

        if (empty($properties)) {
            $properties = $xml->xpath('//transfer[@name="Message"]/property[@name="idMessage"]');
        }

        $this->assertNotEmpty(
            $properties,
            'Message transfer must have a property named "idMessage".',
        );

        $type = (string)$properties[0]['type'];
        $this->assertSame(
            'int',
            $type,
            'Property "idMessage" must be of type "int", got "' . $type . '".',
        );
    }

    public function testMessageTransferHasMessageProperty(): void
    {
        $xml = $this->loadTransferXml();
        $xml->registerXPathNamespace('t', 'spryker:transfer-01');

        $properties = $xml->xpath('//t:transfer[@name="Message"]/t:property[@name="message"]');

        if (empty($properties)) {
            $properties = $xml->xpath('//transfer[@name="Message"]/property[@name="message"]');
        }

        $this->assertNotEmpty(
            $properties,
            'Message transfer must have a property named "message".',
        );

        $type = (string)$properties[0]['type'];
        $this->assertSame(
            'string',
            $type,
            'Property "message" must be of type "string", got "' . $type . '".',
        );
    }
}
