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

use Eki\NRW\Mdl\Working\Responsibility;
use Eki\NRW\Mdl\Working\ResponsibilityInterface;

use PHPUnit\Framework\TestCase;

use stdClass;

class ResponsibilityTest extends TestCase
{
	public function testNormal()
	{
		$obj = new stdClass();
		
		$responsibility = new Responsibility('a role', $obj);

		$this->assertInstanceOf(ResponsibilityInterface::class, $responsibility);		
		$this->assertEquals('a role', $responsibility->getRole());
		$this->assertSame($obj, $responsibility->getActor());
	}
}
