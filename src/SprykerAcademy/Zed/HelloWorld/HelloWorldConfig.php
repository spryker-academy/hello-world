<?php

declare(strict_types = 1);

namespace SprykerAcademy\Zed\HelloWorld;

use SprykerAcademy\Shared\HelloWorld\HelloWorldConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class HelloWorldConfig extends AbstractBundleConfig
{
    public function getMyConfigValue(): string
    {
        return $this->get(HelloWorldConstants::MY_CONFIG_VALUE, 'This is a default value');
    }
}
