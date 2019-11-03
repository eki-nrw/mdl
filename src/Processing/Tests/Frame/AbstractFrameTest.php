<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Frame;

use Eki\NRW\Mdl\Processing\Frame\AbstractFrame;
use Eki\NRW\Mdl\Processing\Frame\FrameInterface;

use PHPUnit\Framework\TestCase;
use \LogicException;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class AbstractFrameTest extends TestCase
{
	public function testInterfaces()
	{
		$frame = $this->createFrame();

		$this->assertInstanceOf(FrameInterface::class, $frame);
	}

	public function testDefaults()
	{
		$frame = $this->createFrame();

		$frame->setType("Frame type");
		$this->assertSame("Frame type", $frame->getType());
		$this->assertEmpty($frame->getFrameInput());
		$this->assertEmpty($frame->getFrameOutput());
		$this->assertNotNull($frame->getStorage());
	}

	public function testActuate()
	{
		$frame = $this->createFrame();

		$this->assertFalse($frame->isActuated());
		$frame->actuate();
		$this->assertTrue($frame->isActuated());
	}
	
	/**
	* @expectedException \LogicException
	* 
	*/
	public function testCannotReActuate()
	{
		$frame = $this->createFrame();

		$frame->actuate();
		$frame->actuate();
	}
	
	private function createFrame()
	{
		$frame = $this->getMockBuilder(AbstractFrame::class)
			->setMethods(['actuating'])
			->getMockForAbstractClass()
		;
		
		$frame
			->expects($this->any())
			->method('actuating')
			->will($this->returnCallback(function () {
				
			}))
		;
		
		return $frame;
	}
}
