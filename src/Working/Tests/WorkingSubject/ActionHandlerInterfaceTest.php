<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\WorkingSubject;

use Eki\NRW\Mdl\Working\WorkingSubject\ActionHandlerInterface;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\ActionHandlerUtils;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\WrongClass;

use PHPUnit\Framework\TestCase;

use stdClass;
use DomainExecption;

class shajhdsaHJKHKHJKHJKhkjhkjhk
{
}

class ActionHandlerInterfaceTest extends TestCase
{
	public function testSupport()
	{
		$actionHandler = $this->createActionHandler();

		$subject = new stdClass();
		$notGoodSubject = new shajhdsaHJKHKHJKHJKhkjhkjhk;

		$this->assertTrue($actionHandler->support($subject, 'define'));		
		$this->assertTrue($actionHandler->support($subject, 'prepare'));		
		$this->assertTrue($actionHandler->support($subject, 'approve'));		
		$this->assertFalse($actionHandler->support($subject, 'unknown'));		
		$this->assertFalse($actionHandler->support($notGoodSubject, 'define'));		
	}
	
	public function testHandle()
	{
		$actionHandler = $this->createActionHandler();

		$subject = new stdClass();

		$actionHandler->handle($subject, 'define');		
		$actionHandler->handle($subject, 'prepare');		
		$actionHandler->handle($subject, 'approve');		
	}

    /**
     * @expectedException \DomainException
     */
	public function testActionWrongSubject()
	{
		$actionHandler = $this->createActionHandler();

		$actionHandler->handle(new shajhdsaHJKHKHJKHJKhkjhkjhk(), 'define');		
	}

    /**
     * @expectedException \DomainException
     */
	public function testActionWrongActionName()
	{
		$actionHandler = $this->createActionHandler();

		$actionHandler->handle(new stdClass(), 'kjkjkjkjkjkj');		
	}


	private function createActionHandler()
	{
		return ActionHandlerUtils::createIActionHandler($this, stdClass::class, array('define', 'prepare', 'approve'));
	}
}
