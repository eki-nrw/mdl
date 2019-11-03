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

use Eki\NRW\Mdl\Working\WorkingSubject\ListActionHandler;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\ActionHandlerUtils;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\ForTestHandlerClass;

//use PHPUnit\Framework\TestCase;

use stdClass;

class ListActionHandlerTest extends BaseActionHandlerTest
{
	private $listHandler;
	
	public function setUp()
	{
		$this->listHandler = $this->getMockBuilder(ListActionHandler::class)
			->setConstructorArgs(array(
				array(
					ActionHandlerUtils::createIActionHandler($this, stdClass::class, array('define', 'prepare', 'approve')),
					ActionHandlerUtils::createIActionHandler($this, stdClass::class, array('sing', 'speak', 'cry')),
					ActionHandlerUtils::createIActionHandler($this, 
						ForTestHandlerClass::class, 
						array('any', 'thing', 'can', 'do')
					),
				)
			))
			->getMockForAbstractClass()
		;
	}
	
	public function tearDown()
	{
		$this->listHandler = null;
	}
	
    /**
    * @dataProvider getGoodConfigs
    */
	public function testSupport($class, $actionName)
	{
		$listHandler = $this->listHandler;
		
		$this->assertTrue($listHandler->support(new $class(), $actionName));
	}
	
    /**
    * @dataProvider getWrongConfigs
    */
	public function testSupportWrong($class, $actionName)
	{
		$listHandler = $this->listHandler;
		
		$this->assertFalse($listHandler->support(new $class(), $actionName));
	}
}
