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

use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\DefinitionInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\Definition;

use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
	public function testSetScope()
	{
		$definition = new Definition();
		
		$this->assertEquals($definition, $definition->setScope("scope_name"));
		$this->assertSame("scope_name", $definition->getScope());
	}

	public function testGetLevel_Not_Set_Before()
	{
		$definition = new Definition();
		
		$this->assertNull($definition->getLevel("a_level_name"));
	}
	
	public function testSetLevel()
	{
		$definition = new Definition();
		
		$this->assertEquals($definition, $definition->setLevel("level_name", "level_value"));
		$this->assertSame("level_value", $definition->getLevel("level_name"));
	}

	/**
	* @expectedException \InvalidArgumentException
	*/
	public function testSetLevel_Wrong()
	{
		$definition = new Definition();
		
		$definition->setLevel("level_name", 100);
	}

	public function testSetLevels()
	{
		$definition = new Definition();
		
		$levels = array(
			'level_name_1' => 'level_value_1',
			'level_name_2' => 'level_value_2',
			'level_name_a' => 'level_value_a',
		);
		
		$this->assertEquals($definition, $definition->setLevels($levels));
		$this->assertSame("level_value_1", $definition->getLevel("level_name_1"));
		$this->assertSame("level_value_a", $definition->getLevel("level_name_a"));
	}

	public function testGetLevels_When_Not_Set_Before_Always_Returns_Empty_Array()
	{
		$definition = new Definition();
		
		$this->assertTrue(is_array($definition->getLevels()));
		$this->assertEmpty($definition->getLevels());
	}
}
