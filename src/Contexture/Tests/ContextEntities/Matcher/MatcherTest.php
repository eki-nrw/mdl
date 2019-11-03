<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Tests\ContextEntities\Matcher;

use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\MatcherInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\Matcher;
use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\DefinitionInterface;

use PHPUnit\Framework\TestCase;
use stdClass;

class __Wrong_Class__
{
	
}

class MatcherTest extends TestCase
{
	public function testConstructor_Empty()
	{
		$matcher = new Matcher();
		
		$this->assertInstanceOf(MatcherInterface::class, $matcher);
	}
	
	public function testMatch()
	{
		$definition = $this->getMockBuilder(DefinitionInterface::class)
			->setMethods(['getConfiguration'])
			->getMockForAbstractClass()
		;
		
		$definition->expects($this->exactly(2))
			->method('getConfiguration')
			->will($this->returnValue(array()))
		;
		
		$matcher = new Matcher(
			$definition,
			function ($obj, $configuration, $arguments) {
				return $obj instanceof stdClass;
			}
		);
		
		$this->assertTrue($matcher->match(new stdClass));
		$this->assertFalse($matcher->match(new __Wrong_Class__));
	}
}
