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

use Eki\NRW\Mdl\Working\ActivityInterface;
use Eki\NRW\Mdl\Working\HasActivityTypeInterface;
use Eki\NRW\Mdl\Working\ResponsibilitiesAwareInterface;
use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesInterface;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ActivityInterfaceTest extends TestCase
{
	public function testInterfaces()
	{
		$r = new ReflectionClass(ActivityInterface::class);
		$interfaces = $r->getInterfaceNames();
		
		// Activity has type
		$this->assertTrue(in_array(HasActivityTypeInterface::class, $interfaces));
		// Activity has object item
		$this->assertTrue(in_array(HasObjectItemInterface::class, $interfaces));
		// Activity has responsibilities aware
		$this->assertTrue(in_array(ResponsibilitiesAwareInterface::class, $interfaces));
		// Activity has times
		$this->assertTrue(in_array(TimingInterface::class, $interfaces));
		// Activity has object states
		$this->assertTrue(in_array(ObjectStatesInterface::class, $interfaces));
	}
}
