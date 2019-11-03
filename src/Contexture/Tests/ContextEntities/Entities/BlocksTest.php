<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Tests\ContextEntities\Entities;

use Eki\NRW\Mdl\Contexture\ContextEntities\Entities\BlocksInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Entities\Blocks;
use Eki\NRW\Mdl\Contexture\ContextEntities\Entities\EntitiesGetterInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Context\ContextInterface;

use PHPUnit\Framework\TestCase;
use stdClass;

class __DummyClass__
{
	
}

class BlocksTest extends TestCase
{
	public function testConstructor()
	{
		$blocks = new Blocks(
			$this->getMockBuilder(ContextInterface::class)->getMock(), 
			$this->getMockBuilder(EntitiesGetterInterface::class)->getMock()
		);
		
		$this->assertInstanceOf(BlocksInterface::class, $blocks);
		$this->assertNull($blocks->getBoundary());
	}

	public function testSetBoundaryAnyObject()
	{
		$context = $this->getMockBuilder(ContextInterface::class)
			->setMethods(['acceptBoundary'])
			->getMockForAbstractClass() 
		;
		
		$context->expects($this->once())
			->method('acceptBoundary')
			->will($this->returnValue(true))
		;
		
		$blocks = new Blocks(
			$context,
			$this->getMockBuilder(EntitiesGetterInterface::class)->getMock()
		);

		$blocks->setBoundary(new __DummyClass__);		
	}

	/**
	* @expectedException \InvalidArgumentException
	*/
	public function testSetBoundaryNotObject()
	{
		$blocks = new Blocks(
			$this->getMockBuilder(ContextInterface::class)->getMock(), 
			$this->getMockBuilder(EntitiesGetterInterface::class)->getMock()
		);

		$blocks->setBoundary([]);		
	}

	public function testSetBoundary_MatchedObject()
	{
		$context = $this->getMockBuilder(ContextInterface::class)
			->setMethods(['acceptBoundary'])
			->getMockForAbstractClass() 
		;
		
		$context->expects($this->once())
			->method('acceptBoundary')
			->will($this->returnCallback(function ($boundary) {
				return $boundary instanceof stdClass;	
			}))
		;
		
		$blocks = new Blocks(
			$context,
			$this->getMockBuilder(EntitiesGetterInterface::class)->getMock()
		);

		$blocks->setBoundary(new stdClass);		
	}

	public function testGetScopes()
	{
		$blocks = new Blocks(
			$this->getContext(array()),
			$this->getMockBuilder(EntitiesGetterInterface::class)->getMock()
		);

		$this->assertTrue(is_array($blocks->getScopes()));		
	}
	
	public function testGetEntities_Empty()
	{
		$blocks = new Blocks(
			$this->getContext(array('scopes' => array())), 
			$this->getMockBuilder(EntitiesGetterInterface::class)->getMock()
		);
		
		$this->assertEmpty($blocks->getEntities());
	}

	public function testGetEntities()
	{
		$blocks = new Blocks(
			$this->getContext(array(
				'scopes' => array(
					'scope_1' => array(
						'level_1_1' => 'one_one',
						'level_1_2' => 'one_two',
					),
					'scope_2' => array(
						'level_2_1' => 'two_one'
					)
				)
			)), 
			$this->getEntitiesGetter(
				array(
					'scope_1' => array(
						'level_1_1' => array(new stdClass, new stdClass),
						'level_1_2' => array(new stdClass),
					),
					'scope_2' => array(
						'level_2_1' => array()
					)
				)
			)
		);
		
		$this->assertNotEmpty($blocks->getEntities());
		$this->assertNotEmpty($blocks->getEntities('scope_1'));
		$this->assertNotEmpty($blocks->getEntities('scope_2'));
		$this->assertNotEmpty($blocks->getEntities('scope_1', 'level_1_1'));
		$this->assertNotEmpty($blocks->getEntities('scope_2', 'level_2_1'));
		
		$this->assertEmpty($blocks->getEntities('scope_1', 'level_2_1'));
		$this->assertEmpty($blocks->getEntities('scope_2', 'level_1_2'));
		
		$this->assertEquals(1, count($blocks->getEntities('scope_1')));
		$this->assertEquals(1, count($blocks->getEntities('scope_1', 'level_1_1')));
		$this->assertEquals(1, count($blocks->getEntities('scope_1', 'level_1_2')));
		$this->assertEquals(1, count($blocks->getEntities('scope_2')));
		$this->assertEquals(1, count($blocks->getEntities('scope_2', 'level_2_1')));
		$this->assertEquals(2, count($blocks->getEntities()));

		$entities = $blocks->getEntities('scope_1', 'level_1_1');
		$this->assertEquals(2, count($entities['scope_1']['level_1_1']));
		
		$entities = $blocks->getEntities('scope_1', 'level_1_2');
		$this->assertEquals(1, count($entities['scope_1']['level_1_2']));
	}
	
	private function getContext(array $configuration)
	{
		$context = $this->getMockBuilder(ContextInterface::class)
			->setMethods(['getScopes'])
			->getMockForAbstractClass() 
		;
		
		$context->expects($this->any())
			->method('getScopes')
			->will($this->returnCallback(function () use ($configuration) {
				if (isset($configuration['scopes']))
					return $configuration['scopes'];
				else
					return array();
			}))
		;

		return $context;
	}
	
	private function getEntitiesGetter(array $data)
	{
		$getter = $this->getMockBuilder(EntitiesGetterInterface::class)
			->setMethods(['getEntities'])
			->getMockForAbstractClass() 
		;
		
		$getter->expects($this->any())
			->method('getEntities')
			->will($this->returnCallback(function ($boundary, $scope, $level) use ($data) {
				if (!isset($data[$scope]))
					return array();

				if (!isset($data[$scope][$level]))
					return array();

				$entities = array();
				foreach($data[$scope][$level] as $obj)
				{
					$entities[] = $obj;
				}
					
				return $entities;
			}))
		;
		
		return $getter;
	}
}
