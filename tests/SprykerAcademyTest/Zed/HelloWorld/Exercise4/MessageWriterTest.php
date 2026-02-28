<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\HelloWorld\Exercise4;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\MessageTransfer;
use SprykerAcademy\Zed\HelloWorld\Business\Writer\MessageWriter;
use SprykerAcademy\Zed\HelloWorld\Persistence\HelloWorldEntityManagerInterface;

/**
 * Exercise 4: Module Layers - MessageWriter
 *
 * Verifies that the MessageWriter delegates to the EntityManager
 * and returns the created message.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/HelloWorld/ Exercise4
 */
class MessageWriterTest extends Unit
{
    public function testCreateDelegatesToEntityManagerAndReturnsResult(): void
    {
        $this->assertWriterClassExists();

        // Arrange
        $inputTransfer = new MessageTransfer();
        $inputTransfer->setMessage('Test Message');

        $savedTransfer = new MessageTransfer();
        $savedTransfer->setIdMessage(42);
        $savedTransfer->setMessage('Test Message');

        $entityManagerMock = $this->createMock(HelloWorldEntityManagerInterface::class);
        $entityManagerMock->expects($this->once())
            ->method('createMessage')
            ->with($inputTransfer)
            ->willReturn($savedTransfer);

        // Act
        $writer = new MessageWriter($entityManagerMock);
        $result = $writer->create($inputTransfer);

        // Assert
        $this->assertSame(
            42,
            $result->getIdMessage(),
            'create() must return the MessageTransfer from the EntityManager.',
        );
        $this->assertSame(
            'Test Message',
            $result->getMessage(),
            'The returned message content must match.',
        );
    }

    private function assertWriterClassExists(): void
    {
        if (!class_exists(MessageWriter::class)) {
            $this->markTestSkipped('MessageWriter class does not exist yet.');
        }

        if (!interface_exists(HelloWorldEntityManagerInterface::class)) {
            $this->markTestSkipped('HelloWorldEntityManagerInterface does not exist yet.');
        }
    }
}
