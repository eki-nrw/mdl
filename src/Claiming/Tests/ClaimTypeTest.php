<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Tests;

use Eki\NRW\Mdl\Claiming\ClaimTypeInterface;
use Eki\NRW\Mdl\Claiming\ClaimType;

use PHPUnit\Framework\TestCase;

class ClaimTypeTest extends TestCase
{
	public function testConstructor()
	{
		$claimType = new ClaimType("given_type");
		
		$this->assertInstanceOf(ClaimTypeInterface::class, $claimType);
		$this->assertEquals($claimType->getType(), "given_type");
	}
}
