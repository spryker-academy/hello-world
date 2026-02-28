<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Client\HelloWorld;

use Generated\Shared\Transfer\MessageCriteriaTransfer;
use Generated\Shared\Transfer\MessageResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;

interface HelloWorldClientInterface
{
    /**
     * - Finds message by defined criteria
     * - Returns a response-transfer which can hold a message if one is found
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MessageCriteriaTransfer $messageCriteria
     */
    public function findMessage(MessageCriteriaTransfer $messageCriteria): MessageResponseTransfer;

    /**
     * Specification:
     * - Creates a message by message-transfer
     * - Returns a message-transfer with the created message-data
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MessageTransfer $messageTransfer
     *
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    public function createMessage(MessageTransfer $messageTransfer): MessageTransfer;
}
