<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Activity\Type;

use Eki\NRW\Mdl\Working\Activity\Type\ActivityType;

use PHPUnit\Framework\TestCase;

class ActivityTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$activityType = new ActivityType();
		
		$this->assertSame('activity', $activityType->getActivityType());
		$this->assertTrue($activityType->is('execute'));
		$this->assertFalse($activityType->is('executesakjdkasjd'));
	}	
}
