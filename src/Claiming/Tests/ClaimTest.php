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

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\Claim;

use PHPUnit\Framework\TestCase;

class ClaimTest extends TestCase
{
	public function testConstructor()
	{
		$claim = new Claim();
		
		$this->assertInstanceOf(ClaimInterface::class, $claim);
	}
}
