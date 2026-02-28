<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\HelloWorld\Exercise4;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\MessageCriteriaTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use SprykerAcademy\Zed\HelloWorld\Business\Reader\MessageReader;
use SprykerAcademy\Zed\HelloWorld\Persistence\HelloWorldRepositoryInterface;

/**
 * Exercise 4: Module Layers - MessageReader
 *
 * Verifies that the MessageReader correctly uses the Repository
 * and returns appropriate responses.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/HelloWorld/ Exercise4
 */
class MessageReaderTest extends Unit
{
    public function testFindMessageReturnsSuccessfulResponseWhenMessageFound(): void
    {
        $this->assertReaderClassExists();

        // Arrange
        $messageTransfer = new MessageTransfer();
        $messageTransfer->setIdMessage(1);
        $messageTransfer->setMessage('Hello');

        $repositoryMock = $this->createMock(HelloWorldRepositoryInterface::class);
        $repositoryMock->method('findMessage')
            ->willReturn($messageTransfer);

        $messageCriteria = new MessageCriteriaTransfer();
        $messageCriteria->setIdMessage(1);

        // Act
        $reader = new MessageReader($repositoryMock);
        $response = $reader->findMessage($messageCriteria);

        // Assert
        $this->assertTrue(
            $response->getIsSuccessful(),
            'findMessage() must return isSuccessful=true when a message is found.',
        );
        $this->assertNotNull(
            $response->getMessage(),
            'findMessage() must set the message on the response when found.',
        );
        $this->assertSame(
            'Hello',
            $response->getMessage()->getMessage(),
            'The returned message must match the one from the Repository.',
        );
    }

    public function testFindMessageReturnsUnsuccessfulResponseWhenMessageNotFound(): void
    {
        $this->assertReaderClassExists();

        // Arrange
        $repositoryMock = $this->createMock(HelloWorldRepositoryInterface::class);
        $repositoryMock->method('findMessage')
            ->willReturn(null);

        $messageCriteria = new MessageCriteriaTransfer();
        $messageCriteria->setIdMessage(999);

        // Act
        $reader = new MessageReader($repositoryMock);
        $response = $reader->findMessage($messageCriteria);

        // Assert
        $this->assertFalse(
            $response->getIsSuccessful(),
            'findMessage() must return isSuccessful=false when no message is found.',
        );
    }

    private function assertReaderClassExists(): void
    {
        if (!class_exists(MessageReader::class)) {
            $this->markTestSkipped('MessageReader class does not exist yet.');
        }

        if (!interface_exists(HelloWorldRepositoryInterface::class)) {
            $this->markTestSkipped('HelloWorldRepositoryInterface does not exist yet.');
        }
    }
}
