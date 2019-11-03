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

use Eki\NRW\Mdl\Working\WorkingSubject\DelegateActionHandler;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\ActionHandlerUtils;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\ForTestHandlerClass;

//use PHPUnit\Framework\TestCase;

use stdClass;
use DomainException;

class DelegateActionHandlerTest extends BaseActionHandlerTest
{
	private $delegateHandler;
	
	public function setUp()
	{
		$this->delegateHandler = new DelegateActionHandler(array(
			ActionHandlerUtils::createIActionHandler($this, stdClass::class, array('define', 'prepare', 'approve')),
			ActionHandlerUtils::createIActionHandler($this, stdClass::class, array('sing', 'speak', 'cry')),
			ActionHandlerUtils::createIActionHandler($this, 
				ForTestHandlerClass::class, 
				array('any', 'thing', 'can', 'do')
			),
		));
	}
	
	public function tearDown()
	{
		$delegateHandler = null;
	}
	
    /**
    * @dataProvider getGoodConfigs
    */
	public function testAction($class, $actionName)
	{
		$delegateHandler = $this->delegateHandler;
		
		$delegateHandler->handle(new $class(), $actionName);
	}

    /**
    * @dataProvider getWrongConfigs
    * @expectedException \DomainException
    */
	public function testActionWrong($class, $actionName)
	{
		$delegateHandler = $this->delegateHandler;
		
		$delegateHandler->handle(new $class(), $actionName);
	}
}
