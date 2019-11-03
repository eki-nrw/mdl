<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests;

use Eki\NRW\Mdl\Working\HasActivityTypeTrait;
use Eki\NRW\Mdl\Working\ActivityTypeInterface;

use PHPUnit\Framework\TestCase;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class HasActivityTypeTraitTest extends TestCase
{
	public function testHasActivityType()
	{
		$trait = $this->getMockBuilder(HasActivityTypeTrait::class)
			->getMockForTrait();
		
		$activityType = $this->getMockBuilder(ActivityTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setActivityType($activityType);
		$this->assertEquals($activityType, $trait->getActivityType());
	}

	public function testAsResetActivityType()
	{
		$trait = $this->getMockBuilder(HasActivityTypeTrait::class)
			->getMockForTrait();
		
		$activityType = $this->getMockBuilder(ActivityTypeInterface::class)
			->disableAutoload()
			->getMock()
		;
		
		$trait->setActivityType($activityType);
		$this->assertEquals($activityType, $trait->getActivityType());
		$trait->setActivityType();
		$this->assertNull($trait->getActivityType());
	}
}
