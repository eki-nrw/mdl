<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Tests\ContextEntities\Context;

use Eki\NRW\Mdl\Contexture\ContextEntities\Context\ContextInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Context\Context;
use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\MatcherInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\Matcher;
use Eki\NRW\Mdl\Contexture\ContextEntities\Context\DefinitionInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Context\Definition;

use PHPUnit\Framework\TestCase;
use stdClass;

final class InternalDef
{
	static public function getBoundaryChecker()
	{
		return
			function ($obj, array $configuration, $arguments) {
				return isset($configuration['boundary']) and ($obj instanceof $configuration['boundary']);
			}
		;
	}
	
	static public function getEntityChecker()
	{
		return
			function ($obj, array $configuration, $arguments) {
				if(isset($arguments['scope']) and isset($arguments['level']))
				{
					return 
						isset($configuration['scopes'][$arguments['scope']][$arguments['level']]) and
						$obj instanceof $configuration['scopes'][$arguments['scope']][$arguments['level']]
					;
				}
				else if(isset($arguments['scope']))
				{
					return 
						isset($configuration['scopes'][$arguments['scope']]) and 
						$obj instanceof $configuration['scopes'][$arguments['scope']]
					;
				}
				else
					return false;	
			}
		;
	}
}

class Boundary extends stdClass
{
	
}

class Child extends stdClass
{
	
}

class Member extends stdClass
{
	
}

class BoundaryMatcher extends Matcher
{
	public function __construct(DefinitionInterface $definition)
	{
		parent::__construct($definition, InternalDef::getBoundaryChecker());
	}
}

class EntityMatcher extends Matcher
{
	public function __construct(DefinitionInterface $definition)
	{
		parent::__construct($definition, InternalDef::getEntityChecker());
	}
}

class WrongMatcher
{
	
}

class ContextTest extends TestCase
{
	private $configuration;
	private $boundaryChecker;
	private $entityChecker;
	
	public function setUp()
	{
		$this->configuration = 
			array(
				'boundary' => Boundary::class,
				'scopes' => array(
					'owns' => array(
						'child' => Child::class,
						'member' => Member::class
					)
				)
			)
		;
		
		$this->boundaryChecker = InternalDef::getBoundaryChecker();
		$this->entityChecker = InternalDef::getEntityChecker();
	}
	
	public function tearDown()
	{
		$this->configuration = null;
		$this->boundaryChecker = null;
		$this->entityChecker = null;
	}
	
	public function testConstructor_Checker()
	{
		$context = new Context(
			"context_name",
			new Definition($this->configuration),
			$this->boundaryChecker,
			$this->entityChecker
		);
		
		$this->assertInstanceOf(ContextInterface::class, $context);
		$this->assertInstanceOf(Context::class, $context);
		$this->assertSame($context->getName(), "context_name");
		$this->assertTrue($context->acceptBoundary(new Boundary));
		$this->assertTrue($context->supportEntity(new Child(), 'owns', 'child'));
		$this->assertTrue($context->supportEntity(new Member(), 'owns', 'member'));
		$this->assertFalse($context->supportEntity(new Child(), 'owns', 'nephew'));
		$this->assertFalse($context->supportEntity(new Member(), 'owns', 'cousin'));
	}

	public function testConstructor_MatcherClassname()
	{
		$context = new Context(
			"context_name",
			new Definition($this->configuration),
			BoundaryMatcher::class,
			EntityMatcher::class
		);
		
		$this->assertInstanceOf(ContextInterface::class, $context);
		$this->assertInstanceOf(Context::class, $context);
		$this->assertSame($context->getName(), "context_name");
		$this->assertTrue($context->acceptBoundary(new Boundary));
		$this->assertTrue($context->supportEntity(new Child(), 'owns', 'child'));
		$this->assertTrue($context->supportEntity(new Member(), 'owns', 'member'));
		$this->assertFalse($context->supportEntity(new Child(), 'owns', 'nephew'));
		$this->assertFalse($context->supportEntity(new Member(), 'owns', 'cousin'));
	}

	public function testConstructor_Matcher()
	{
		$definition = new Definition($this->configuration);
		$context = new Context(
			"context_name",
			$definition,
			new BoundaryMatcher($definition),
			new EntityMatcher($definition)
		);
		
		$this->assertInstanceOf(ContextInterface::class, $context);
		$this->assertInstanceOf(Context::class, $context);
		$this->assertSame($context->getName(), "context_name");
		$this->assertTrue($context->acceptBoundary(new Boundary));
		$this->assertTrue($context->supportEntity(new Child(), 'owns', 'child'));
		$this->assertTrue($context->supportEntity(new Member(), 'owns', 'member'));
		$this->assertFalse($context->supportEntity(new Child(), 'owns', 'nephew'));
		$this->assertFalse($context->supportEntity(new Member(), 'owns', 'cousin'));
	}

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/
	public function testConstructor_WrongBoundaryMatcherClassname()
	{
		$context = new Context(
			"context_name",
			new Definition($this->configuration),
			WrongMatcher::class,
			EntityMatcher::class
		);
	}

	/**
	* 
	* @expectedException \InvalidArgumentException
	*/
	public function testConstructor_WrongEntityMatcherClassname()
	{
		$context = new Context(
			"context_name",
			new Definition($this->configuration),
			BoundaryMatcher::class,
			WrongMatcher::class
		);
	}
}
