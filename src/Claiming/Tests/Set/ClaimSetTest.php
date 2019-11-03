<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Tests\Set;

use Eki\NRW\Mdl\Claiming\Set\ClaimSetInterface;
use Eki\NRW\Mdl\Claiming\Set\ClaimSet;
use Eki\NRW\Mdl\Claiming\Set\SetInterface;
use Eki\NRW\Mdl\Claiming\ClaimInterface;

use PHPUnit\Framework\TestCase;

class ClaimSetTest extends TestCase
{
	public function testConstructor()
	{
		$claimSet = new ClaimSet();
		
		$this->assertInstanceOf(ClaimSetInterface::class, $claimSet);
		$this->assertInstanceOf(ClaimInterface::class, $claimSet);
		$this->assertInstanceOf(SetInterface::class, $claimSet);
	}
}
