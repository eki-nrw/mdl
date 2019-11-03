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

use Eki\NRW\Mdl\Working\AbstractBuildingSubject;
use Eki\NRW\Mdl\Working\BuildingSubjectInterface;

use PHPUnit\Framework\TestCase;

class AbstractBuildingSubjectTest extends TestCase
{
	public function testInterfaces()
	{
		$buildingSubject = $this->createBuildingSubject();
		
		$this->assertInstanceOf(BuildingSubjectInterface::class, $buildingSubject);
	}
	
	private function createBuildingSubject()
	{
		$buildingSubject = $this->getMockBuilder(AbstractBuildingSubject::class)
			->getMockForAbstractClass()
		;
		
		return $buildingSubject;
	}
}
