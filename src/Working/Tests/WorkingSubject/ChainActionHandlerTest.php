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

use Eki\NRW\Mdl\Working\WorkingSubject\ChainActionHandler;

use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Utils\ActionHandlerUtils;
use Eki\NRW\Mdl\Working\Tests\WorkingSubject\Fixtures\ForTestHandlerClass;

//use PHPUnit\Framework\TestCase;

use stdClass;
use DomainException;

class ChainActionHandlerTest extends BaseActionHandlerTest
{
	private $chainHandler;
	
	public function setUp()
	{
		$this->chainHandler = new ChainActionHandler(array(
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
		$chainHandler = null;
	}
	
    /**
    * @dataProvider getGoodConfigs
    */
	public function testHandle($class, $actionName)
	{
		$chainHandler = $this->chainHandler;
		
		$chainHandler->handle(new $class(), $actionName);
	}

    /**
    * @dataProvider getWrongConfigs
    * @expectedException \DomainException
    */
	public function testHandleWrong($class, $actionName)
	{
		$chainHandler = $this->chainHandler;
		
		$chainHandler->handle(new $class(), $actionName);
	}
}
