<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Actuate\Actuator\Simple;

use Eki\NRW\Mdl\Processing\Actuate\Actuator\Simple\MaterialGetter;

use PHPUnit\Framework\TestCase;

use stdClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class MaterialGetterTest extends TestCase
{
	public function testGet()
	{
		$getter = $this->getMaterialGetter();
		
		$material = new stdClass();
		$material->number = 99;
		$obj = new stdClass();
		$obj->material = $material;

		$mat = $getter->get($obj);
		$this->assertSame(99, $mat->number);
	}

	public function testGetWithSubject()
	{
		$getter = $this->getMaterialGetter();
		
		$material = new stdClass();
		$material->number = 99;
		$obj = new stdClass();
		$obj->material = $material;

		$mat = $getter->belongSubject($obj)->get();
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testGetNoSubject()
	{
		$getter = $this->getMaterialGetter();
		
		$material = new stdClass();
		$material->number = 99;
		$obj = new stdClass();
		$obj->material = $material;

		$mat = $getter->get();
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testGetAfterResetSubject()
	{
		$getter = $this->getMaterialGetter();
		
		$material = new stdClass();
		$material->number = 99;
		$obj = new stdClass();
		$obj->material = $material;

		$mat = $getter->belongSubject($obj)->get();
		$getter->belongSubject();   // reset		
		$mat = $getter->get();
	}
	
	private function getMaterialGetter()
	{
		$getter = new MaterialGetter(
			Helper::materialGetterFunc(),
			function ($subject) {
				return $subject instanceof stdClass;
			}
		);
		
		return $getter;
	}
}
