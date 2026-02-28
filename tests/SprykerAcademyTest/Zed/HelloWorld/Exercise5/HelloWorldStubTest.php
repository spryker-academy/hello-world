<?php

declare(strict_types=1);

namespace SprykerAcademyTest\Zed\HelloWorld\Exercise5;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\MessageCriteriaTransfer;
use Generated\Shared\Transfer\MessageResponseTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerAcademy\Client\HelloWorld\Stub\HelloWorldStub;

/**
 * Exercise 5: Module Layers - Storefront (Client Stub)
 *
 * Verifies that the HelloWorldStub calls the correct gateway path
 * to communicate between Yves and Zed.
 *
 * Run: vendor/bin/codecept run -c tests/SprykerAcademyTest/Zed/HelloWorld/ Exercise5
 */
class HelloWorldStubTest extends Unit
{
    private const EXPECTED_GATEWAY_PATH = '/hello-world/gateway/find-message';

    public function testFindMessageCallsCorrectGatewayPath(): void
    {
        $this->assertStubClassExists();

        // Arrange
        $messageCriteria = new MessageCriteriaTransfer();
        $messageCriteria->setIdMessage(1);

        $expectedResponse = new MessageResponseTransfer();
        $expectedResponse->setIsSuccessful(true);

        $zedRequestClientMock = $this->createMock(ZedRequestClientInterface::class);
        $zedRequestClientMock->expects($this->once())
            ->method('call')
            ->with(
                self::EXPECTED_GATEWAY_PATH,
                $messageCriteria,
            )
            ->willReturn($expectedResponse);

        // Act
        $stub = new HelloWorldStub($zedRequestClientMock);
        $result = $stub->findMessage($messageCriteria);

        // Assert
        $this->assertInstanceOf(
            MessageResponseTransfer::class,
            $result,
            'findMessage() must return a MessageResponseTransfer.',
        );
    }

    public function testStubUsesZedRequestClient(): void
    {
        $this->assertStubClassExists();

        $reflection = new \ReflectionClass(HelloWorldStub::class);
        $constructor = $reflection->getConstructor();

        $this->assertNotNull(
            $constructor,
            'HelloWorldStub must have a constructor.',
        );

        $params = $constructor->getParameters();
        $this->assertGreaterThanOrEqual(
            1,
            count($params),
            'HelloWorldStub constructor must accept at least one parameter (ZedRequestClientInterface).',
        );
    }

    private function assertStubClassExists(): void
    {
        if (!class_exists(HelloWorldStub::class)) {
            $this->markTestSkipped('HelloWorldStub class does not exist yet.');
        }

        if (!interface_exists(ZedRequestClientInterface::class)) {
            $this->markTestSkipped('ZedRequestClientInterface is not available.');
        }
    }
}
