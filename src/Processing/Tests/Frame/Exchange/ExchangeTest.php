<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Exchange;

use Eki\NRW\Mdl\Processing\Frame\Exchange\ExchangeInterface;
use Eki\NRW\Mdl\Processing\Frame\Exchange\Exchange;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ExchangeTest extends TestCase
{
	public function testDefaults()
	{
		$exchange = new Exchange();
		
		$this->assertInstanceOf(ExchangeInterface::class, $exchange);
	}
}
