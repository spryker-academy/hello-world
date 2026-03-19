<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Zed\ContactRequest\Communication\Controller;

use Generated\Shared\Transfer\ContactRequestTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerAcademy\Zed\ContactRequest\Business\ContactRequestFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    /**
     * @return array<string, mixed>
     */
    public function indexAction(): array
    {
        $contactRequestTransfer = new ContactRequestTransfer();
        $contactRequestTransfer->setMessage('Contact Request!');
        $contactRequestTransfer->setIdContactRequest(1);

        return $this->viewResponse([
            'contactRequest' => $contactRequestTransfer,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function addAction(Request $request): array
    {
        $message = $request->query->get('message', 'test');

        $contactRequestCriteriaTransfer = null;
        // TODO: Instantiate ContactRequestCriteriaTransfer and set the message
        // Use $this->getFacade()->findContactRequest() with the criteria transfer
        // Assign the ContactRequestTransfer from the response to $contactRequestTransfer
        $contactRequestTransfer = null;

        if (!$contactRequestTransfer) {
            // TODO: If no contact request with that message exists,
            // create a ContactRequestTransfer, set the message,
            // and persist it with $this->getFacade()->createContactRequest()
        }

        return $this->viewResponse([
            'message' => $contactRequestTransfer,
        ]);
    }
}
