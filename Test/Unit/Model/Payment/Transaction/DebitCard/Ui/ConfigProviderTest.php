<?php

namespace Webjump\BraspagPagador\Test\Unit\Model\Payment\Transaction\DebitCard\Ui;

use Webjump\BraspagPagador\Model\Payment\Transaction\DebitCard\Ui\ConfigProvider;

class ConfigProviderTest extends \PHPUnit\Framework\TestCase
{
	private $configProvider;
	private $debitcardConfig;

	public function setUp()
	{
		$this->debitcardConfig = $this->createMock('Webjump\BraspagPagador\Gateway\Transaction\DebitCard\Config\ConfigInterface');

		$this->configProvider = new ConfigProvider(
			$this->debitcardConfig
		);
	}

    public function testGetConfig()
    {
    	$this->debitcardConfig->expects($this->once())
    		->method('isSuperDebitoActive')
    		->will($this->returnValue(true));

        static::assertEquals(
            [
                'payment' => [
                    'dcform' => [
                        'superdebito' => [
                            'active' => ['braspag_pagador_debitcard' => true]
                        ],
                    ],
                    'redirect_after_place_order' => null
                ]
            ],
            $this->configProvider->getConfig()
        );
    }

    public function testGetConfigDisabled()
    {
    	$this->debitcardConfig->expects($this->once())
    		->method('isSuperDebitoActive')
    		->will($this->returnValue(false));

        static::assertEquals(
            [
                'payment' => [
                    'dcform' => [
                        'superdebito' => [
                            'active' => ['braspag_pagador_debitcard' => false]
                        ],
                    ],
                    'redirect_after_place_order' => null
                ]
            ],
            $this->configProvider->getConfig()
        );
    }
}
