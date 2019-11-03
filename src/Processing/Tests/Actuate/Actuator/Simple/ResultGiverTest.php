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

use Eki\NRW\Mdl\Processing\Actuate\Actuator\Simple\ResultGiver;

use PHPUnit\Framework\TestCase;

use stdClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ResultGiverTest extends TestCase
{
	public function testGet()
	{
		$giver = $this->getResultGiver();
		
		$result = new stdClass();
		$result->number = 99;
		$obj = new stdClass();

		$subject = $giver->give($result, $obj);
		$res = $subject->result;
		$this->assertSame(99, $res->number);
	}

	public function testGetWithSubject()
	{
		$giver = $this->getResultGiver();
		
		$result = new stdClass();
		$result->number = 99;
		$obj = new stdClass();

		$subject = $giver->belongSubject($obj)->give($result);
		$this->assertSame($obj, $subject);
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testGetNoSubject()
	{
		$giver = $this->getResultGiver();
		
		$result = new stdClass();
		$result->number = 99;
		$obj = new stdClass();

		$giver->give($result);
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testGetAfterResetSubject()
	{
		$giver = $this->getResultGiver();
		
		$result = new stdClass();
		$result->number = 99;
		$obj = new stdClass();

		$giver->belongSubject($obj)->give($result);
		$giver->belongSubject();   // reset		
		$giver->give($result);
	}
	
	private function getResultGiver()
	{
		$giver = new ResultGiver(
			Helper::resultGiverFunc(),
			function ($subject) {
				return $subject instanceof stdClass;
			}
		);
		
		return $giver;
	}
}
