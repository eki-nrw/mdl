<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Exchange;

use Eki\NRW\Mdl\Processing\Frame\Exchange\AbstractExchange;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Mdl\Processing\Element;

use PHPUnit\Framework\TestCase;
use stdClass;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class AbstractExchangeTest extends TestCase
{
	public function testDefaults()
	{
		$exchange = $this->createExchange();

		$this->assertSame("exchange", $exchange->getFrameType());
		$exchange->setType("Exchange type");
		$this->assertSame("Exchange type", $exchange->getType());		
	}
	
	public function testReceive()
	{
		$exchange = $this->createExchange();

		$obj_1 = $this->createReceiveSubject();
		$receive_1 = new Element("receive_1", $obj_1);
		$exchange->receive($receive_1, []);
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testReceiveTwice()
	{
		$exchange = $this->createExchange();

		$obj_1 = $this->createReceiveSubject();
		$receive_1 = new Element("receive", $obj_1);
		$exchange->receive($receive_1, []);

		$obj_2 = $this->createReceiveSubject();
		$receive_2 = new Element("receive another", $obj_2);
		$exchange->receive($receive_2, []);
	}

	/**
	* @dataProvider GetDataForReceive
	* 
	*/
	public function testGetReceive($name)
	{
		$exchange = $this->createExchange();

		$obj = $this->createReceiveSubject();
		$obj->name = $name;
		$receive = new Element(null, $obj);
		$exchange->receive($receive, []);
		
		$__receive = $exchange->getReceive();
		$this->assertSame($receive, $__receive);
		$this->assertSame($name, $__receive->getSubject()->name);
	}
	
	public function GetDataForReceive()
	{
		static $str = "lsadlaslkdlsaldksladlsad askhdak";
		
		return [
			[ str_shuffle($str) ],
			[ str_shuffle($str) ],
			[ str_shuffle($str) ],
			[ str_shuffle($str) ],
			[ str_shuffle($str) ],
			[ str_shuffle($str) ],
		];
	}

	/**
	* @expectedException \LogicException
	* 
	*/
	public function testProvideWithoutPrepare()
	{
		$exchange = $this->createExchange();

		$obj = $this->createProvideSubject();
		$provide = new Element(null, $obj);
		$exchange->provide($provide, []);
	}

	public function testProvideNormal()
	{
		$exchange = $this->createExchange();

		$obj = $this->createReceiveSubject();
		$obj->name = "Receive";
		$receiveElem = new Element(null, $obj);
		$exchange->receive($receiveElem, []);

		$exchange->actuate();

		$obj = $this->createProvideSubject();
		$provide = new Element(null, $obj);
		$exchange->provide($provide, []);
		
		$__provide = $exchange->getProvide();
		$this->assertSame($__provide, $provide);
	}
	
	public function testCanPipeFromFirst()
	{
		$exchange = $this->createExchange();

		$this->assertFalse($exchange->canPipe());
	}

	public function testCanPipeFromWhenActuated()
	{
		$exchange = $this->createExchange();

		$exchange->actuate();
		$this->assertFalse($exchange->canPipe());
	}

	public function testCanPipeToFirst()
	{
		$exchange = $this->createExchange();

		$this->assertTrue($exchange->canPipeIn("a_key", $this->getMockBuilder(ElementInterface::class)->getMock(), []));
	}

	public function testCanPipeToWhenActuated()
	{
		$exchange = $this->createExchange();

		$exchange->actuate();
		$this->assertFalse($exchange->canPipeIn("a_key", $this->getMockBuilder(ElementInterface::class)->getMock(), []));
	}
	
	public function testPipeIn()
	{
		
	}

	private function createReceiveSubject()
	{
		$subject =  new stdClass;
		
		return $subject;
	}

	private function createProvideSubject()
	{
		$subject =  new stdClass;
		
		return $subject;
	}

	private function createExchange()
	{
		$exchange = $this->getMockBuilder(AbstractExchange::class)
			->setMethods(['actuating', 'pack'])
			->getMockForAbstractClass()
		;

		$exchange
			->expects($this->any())
			->method('actuating')
			->will($this->returnCallback(function () {
				
			}))
		;
		
		$exchange
			->expects($this->any())
			->method('pack')
			->will($this->returnCallback(function (array $frameProvides, array $contexts) {
				$frameProvide = reset($frameProvides);
				$subject = $frameProvide->getSubject();
				$subject->packedString = str_shuffle("Data packing. Data packed. Data packs.");
				$frameProvide->setSubject($subject);
				return array($frameProvide);
			}))
		;

		return $exchange;
	}
}
