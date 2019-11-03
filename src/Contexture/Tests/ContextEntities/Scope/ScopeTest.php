<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Tests\ContextEntities\Scope;

use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\ScopeInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\Scope;
use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\DefinitionInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\Definition;

use PHPUnit\Framework\TestCase;
use stdClass;

class ScopeTest extends TestCase
{
	public function testConstructor_Empty()
	{
		$scope = new Scope($this->getMockBuilder(DefinitionInterface::class)->getMock());
		
		$this->assertInstanceOf(ScopeInterface::class, $scope);
	}

	public function testConstructor_w_Definition()
	{
		$scope = new Scope(
			(new Definition())
				->setName("scope_name")
		);
		
		$this->assertSame("scope_name", $scope->getName());
	}
}
