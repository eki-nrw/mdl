<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Activity;

use Eki\NRW\Mdl\Working\Activity\Activity;
use Eki\NRW\Mdl\Working\ActivityTypeInterface;
use Eki\NRW\Mdl\Working\Activity\Type\ActivityType;

use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
	public function testNormal()
	{
		$activity = new Activity(new ActivityType());
		
		$this->assertTrue($activity->getActivityType()->is('execute'));
		$this->assertFalse($activity->getActivityType()->is('abcdef'));
	}
	
	public function testNewInstance()
	{
		$activity = new Activity($this->createActivityType('execute'));

		$this->assertTrue($activity->getActivityType()->is('execute'));
		$this->assertFalse($activity->getActivityType()->is('abcdef'));
	}	

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testNewInstance_Wrong()
	{
		$activity = new Activity($this->createActivityType('aslkjdlasldk'));
	}	
	
	private function createActivityType($matchThing)
	{
		$activityType = $this->getMockBuilder(ActivityTypeInterface::class)
			->setMethods(['is'])
			->getMockForAbstractClass()
		;
		
		$activityType->expects($this->any())
			->method('is')
			->will($this->returnCallback(function ($thing) use ($matchThing) {
				if ($thing === $matchThing)
					return true;
				return false;
			}))
		;
		
		return $activityType;
	}
}
