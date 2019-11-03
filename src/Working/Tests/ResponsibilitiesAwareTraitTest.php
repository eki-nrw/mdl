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

use Eki\NRW\Mdl\Working\ResponsibilitiesAwareTrait;
use Eki\NRW\Mdl\Working\ResponsibilityInterface;

use PHPUnit\Framework\TestCase;

use stdClass;

class ResponsibilitiesAwareTraitTest extends TestCase
{
	public function testInternal()
	{
		$responsibility_a = $this->createResponsibility('role_a');
		$responsibility_b = $this->createResponsibility('role_b');
		
		$this->assertNotSame($responsibility_a, $responsibility_b);
		$this->assertNotSame($responsibility_a->getRole(), $responsibility_b->getRole());
	}
	
	public function testSetResponsibility()
	{
		$responsibilities = $this->createResponsibilitiesAwareTrait();

		$responsibility_a = $this->createResponsibility('role_a');
		$responsibilities->setResponsibility($responsibility_a);

		$responsibility_b = $this->createResponsibility('role_b');
		$responsibilities->setResponsibility($responsibility_b);
		
		$this->assertTrue($responsibilities->hasResponsibility('role_a'));
		$this->assertTrue($responsibilities->hasResponsibility('role_b'));
		
		$this->assertSame($responsibility_a, $responsibilities->getResponsibility('role_a'));
		$this->assertSame($responsibility_b, $responsibilities->getResponsibility('role_b'));
	}

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testSetResponsibility_Override()
	{
		$responsibilities = $this->createResponsibilitiesAwareTrait();

		$responsibility_a = $this->createResponsibility('role_x');
		$responsibility_b = $this->createResponsibility('role_x');
		
		$responsibilities->setResponsibility($responsibility_a);
		$responsibilities->setResponsibility($responsibility_b);
	}

	public function testSetResponsibilityOverrideBySetNullFirst()
	{
		$responsibilities = $this->createResponsibilitiesAwareTrait();

		$responsibility_a = $this->createResponsibility('role_x');
		$responsibility_b = $this->createResponsibility('role_x');
		
		$responsibilities->setResponsibility($responsibility_a);
		$responsibilities->setResponsibility(null, 'role_x');
		$responsibilities->setResponsibility($responsibility_b);
	}

	public function testResponsibilities()
	{
		$responsibilities = $this->createResponsibilitiesAwareTrait();

		$this->assertEmpty($responsibilities->getResponsibilities());
		
		$responsibilities->setResponsibilities(array(
			$this->createResponsibility('role_x'),
			$this->createResponsibility('role_y'),
		));
		
		$this->assertEquals(2, sizeof($responsibilities->getResponsibilities()));
	}

    /**
     * @expectedException \InvalidArgumentException
     */
	public function testResponsibilities_SetNotResponsibility()
	{
		$responsibilities = $this->createResponsibilitiesAwareTrait();

		$this->assertEmpty($responsibilities->getResponsibilities());

		$responsibilities->setResponsibilities(array(
			$this->createResponsibility('role_x'),
			$this->createResponsibility('role_y'),
			new stdClass()
		));
	}

	private function createResponsibilitiesAwareTrait()
	{
		return $this->getMockBuilder(ResponsibilitiesAwareTrait::class)
			->getMockForTrait()
		;
	}
	
	private function createResponsibility($role)
	{
		$responsibility = $this->getMockBuilder(ResponsibilityInterface::class)
			->setMethods(['getRole'])
			->getMockForAbstractClass()
		;
		
		$responsibility->expects($this->any())
			->method('getRole')
			->will($this->returnValue($role))
		;
		
		return $responsibility;
	}
}
