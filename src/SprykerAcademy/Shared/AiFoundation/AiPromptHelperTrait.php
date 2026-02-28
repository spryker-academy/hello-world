<?php

namespace SprykerAcademy\Shared\AiFoundation;

use Generated\Shared\Transfer\PromptMessageTransfer;
use Generated\Shared\Transfer\PromptRequestTransfer;
use Spryker\Zed\AiFoundation\Business\AiFoundationFacadeInterface;


trait AiPromptHelperTrait
{
    const string CONVERSATION_REFERENCE = 'spryker';
    const int MAX_RETRIES = 3;

    protected function promptText(string $userInput): string
    {
        $promptRequest = new PromptRequestTransfer()
            ->setPromptMessage(new PromptMessageTransfer()->setContent($userInput))->setConversationReferenceOrFail(
                self::CONVERSATION_REFERENCE
            )->setMaxRetries(self::MAX_RETRIES);

        return (string)$this->getAiFoundationFacade()
            ->prompt($promptRequest)
            ->getMessage()
            ?->getContent();
    }

    protected function getAiFoundationFacade(): AiFoundationFacadeInterface
    {
        if (!isset($this->aiFoundationFacade) || !$this->aiFoundationFacade instanceof AiFoundationFacadeInterface) {
            throw new \LogicException(
                'Controller must have a promoted $aiFoundationFacade: AiFoundationFacadeInterface.'
            );
        }

        return $this->aiFoundationFacade;
    }
}
