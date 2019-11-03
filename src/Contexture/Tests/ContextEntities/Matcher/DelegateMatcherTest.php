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
use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\DelegateMatcher;

use PHPUnit\Framework\TestCase;
use stdClass;

class DelegateMatcherTest extends TestCase
{
	public function testConstructor_Empty()
	{
		$delegateMatcher = new DelegateMatcher();
		
		$this->assertInstanceOf(MatcherInterface::class, $delegateMatcher);
	}

	/**
	* @expectedException \InvalidArgumentException
	*/
	public function testConstructor_w_Wrong_Matcher()
	{
		$delegateMatcher = new DelegateMatcher(array(new stdClass));
	}
	
	public function testMatch_Matched()
	{
		$delegateMatcher = new DelegateMatcher(array(
			$this->createMatcher(false),
			$this->createMatcher(true),
			$this->createMatcher(false)
		));
		
		$this->assertTrue($delegateMatcher->match(new stdClass));
	}

	public function testMatch_Not_Matched()
	{
		$delegateMatcher = new DelegateMatcher(array(
			$this->createMatcher(false),
			$this->createMatcher(false),
			$this->createMatcher(false)
		));
		
		$this->assertFalse($delegateMatcher->match(new stdClass));
	}
	
	private function createMatcher($expectedMatch)
	{
		$matcher = $this->getMockBuilder(MatcherInterface::class)
			->setMethods(['match'])
			->getMockForAbstractClass()
		;
		
		$matcher->expects($this->any())
			->method('match')
			->will($this->returnCallback(function ($obj, $arguments = null) use ($expectedMatch) {
				return $expectedMatch;
			}))
		;
		
		return $matcher;
	}
}
