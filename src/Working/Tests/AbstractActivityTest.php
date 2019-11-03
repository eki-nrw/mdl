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

use Eki\NRW\Mdl\Working\AbstractActivity;

use PHPUnit\Framework\TestCase;

use ReflectionClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class AbstractActivityTest extends TestCase
{
	public function testDefaults()
	{
		$activity = $this->getMockBuilder(AbstractActivity::class)
			->getMockForAbstractClass()
		;
		
		$this->assertNull($activity->getName());
		$this->assertNull($activity->getActivityType());
		$this->assertNull($activity->getObjectItem());
		$this->assertEmpty($activity->getResponsibilities());
		$this->assertEmpty($activity->getTimes());
	}
}
