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

use Eki\NRW\Mdl\Claiming\ClaimableInterface;
use Eki\NRW\Mdl\Claiming\Claimable;
use Eki\NRW\Mdl\Claiming\SubjectableInterface;
use Eki\NRW\Mdl\Claiming\OriginableInterface;
use Eki\NRW\Mdl\Claiming\DeliverableInterface;

use PHPUnit\Framework\TestCase;

class ClaimableTest extends TestCase
{
	public function testConstructor()
	{
		$claimable = new Claimable();

		$this->assertInstanceOf(ClaimableInterface::class, $claimable);
	}

	public function testConstructor_w_Subjectable()
	{
		$claimable = new Claimable(
			$this->getMockBuilder(SubjectableInterface::class)->getMock()
		);

		$this->assertNotNull($claimable->getSubjectable());
	}

	public function testConstructor_w_Originable()
	{
		$claimable = new Claimable(
			null,
			$this->getMockBuilder(OriginableInterface::class)->getMock()
		);

		$this->assertNotNull($claimable->getOriginable());
	}

	public function testConstructor_w_Deliverable()
	{
		$claimable = new Claimable(
			null,
			null,
			$this->getMockBuilder(DeliverableInterface::class)->getMock()
		);

		$this->assertNotNull($claimable->getDeliverable());
	}

	public function testConstructor_w_Full()
	{
		$claimable = new Claimable(
			$this->getMockBuilder(SubjectableInterface::class)->getMock(),
			$this->getMockBuilder(OriginableInterface::class)->getMock(),
			$this->getMockBuilder(DeliverableInterface::class)->getMock()
		);

		$this->assertNotNull($claimable->getSubjectable());
		$this->assertNotNull($claimable->getOriginable());
		$this->assertNotNull($claimable->getDeliverable());
	}
}
