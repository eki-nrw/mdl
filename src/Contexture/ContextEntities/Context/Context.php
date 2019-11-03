<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context;

use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\MatcherInterface;
use Eki\NRW\Mdl\Contexture\ContextEntities\Matcher\Matcher;

use Closure;
use ReflectionClass;

/**
* Context implementation 
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Context implements ContextInterface
{
	/**
	* @var DefinitionInterface
	*/
	private $definition;
	
	/**
	* @var string
	*/
	protected $name;
	
	/**
	* @var MatcherInterface
	*/
	protected $boundaryMatcher;
	
	/**
	* @var MatcherInterface
	*/
	protected $entityMatcher;
	
	/**
	* Constructor
	* 
	* @param Definition $definition
	* @param string|Closure|MatcherInterface $boundaryMatcher
	* @param string|Closure|MatcherInterface $entityMatcher
	* @param string $name
	* 
	*/
	public function __construct(
		$name,
		DefinitionInterface $definition, 
		$boundaryMatcher,
		$entityMatcher
	)
	{
		$this->name = $name;
		$this->definition = $definition;

		if (is_string($boundaryMatcher))
		{
			if (!class_exists($boundaryMatcher))
				throw new \InvalidArgumentException("Class '$boundaryMatcher' not found.");
			else if (!(new ReflectionClass($boundaryMatcher))->implementsInterface(MatcherInterface::class))
				throw new \InvalidArgumentException(sprintf("Class '$boundaryMatcher' do not implement %s.", MatcherInterface::class));

			$this->boundaryMatcher = new $boundaryMatcher($definition);
		}
		else if ($boundaryMatcher instanceof MatcherInterface)
		{
			$this->boundaryMatcher = $boundaryMatcher;
		}
		else if ($boundaryMatcher instanceof Closure)
		{
			$this->boundaryMatcher = new Matcher($definition, $boundaryMatcher);
		}
		else
		{
			throw new \InvalidArgumentException(sprintf(
				"Parameter 'boundaryMatcher' must be class that impements %s, Closure or instance of %s.",
				MatcherInterface::class,
				MatcherInterface::class
			));	
		}

		if (is_string($entityMatcher))		
		{
			if (!class_exists($entityMatcher))
				throw new \InvalidArgumentException("Class '$entityMatcher' not found.");
			else if (!(new ReflectionClass($entityMatcher))->implementsInterface(MatcherInterface::class))
				throw new \InvalidArgumentException(sprintf("Class '$entityMatcher' do not implement %s.", MatcherInterface::class));
			
			$this->entityMatcher = new $entityMatcher($definition);
		}
		else if ($entityMatcher instanceof MatcherInterface)
		{
			$this->entityMatcher = $entityMatcher;
		}
		else if ($entityMatcher instanceof Closure)
		{
			$this->entityMatcher = new Matcher($definition, $entityMatcher);
		}
		else
		{
			throw new \InvalidArgumentException(sprintf(
				"Parameter 'entityMatcher' must be class that implements %s, Closure or instance of %s.",
				MatcherInterface::class,
				MatcherInterface::class
			));	
		}
	}
	
	/*
	* @inheritdoc
	* 
	*/
	public function setDefinition(DefinitionInterface $definition = null)
	{
		$this->definition = $definition;		
	}
	
	/*
	* @inheritdoc
	* 
	*/
	public function getDefinition()
	{
		return $this->definition;
	}
	
	/*
	* @inheritdoc
	* 
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/*
	* @inheritdoc
	* 
	*/
	public function acceptBoundary($boundary)
	{
		return $this->boundaryMatcher->match($boundary);
	}
	
	/*
	* @inheritdoc
	* 
	*/
	public function supportEntity($entity, $scope = null, $level = null)
	{
		return $this->entityMatcher->match(
			$entity, 
			array(
				'scope' => $scope, 
				'level' => $level
			)
		);
	}

	/*
	* @inheritdoc
	* 
	*/
	public function hasScope($scope, $level = null)
	{
		$config = $this->definition->getConfiguration();
		
		if (!isset($config['scopes'][$scope]))
			return false;
			
		if ($level !== null)
			if (!isset($config['scopes'][$scope][$level]))
				return false;
		
		return true;
	}

	/*
	* @inheritdoc
	* 
	*/
	public function getScopes()
	{
		$config = $this->definition->getConfiguration();

		if (isset($config['scopes']))
			return $config['scopes'];
			
		return array(); 
	}

	/*
	* @inheritdoc
	* 
	*/
	public function getLevels($scope)
	{
		$config = $this->definition->getConfiguration();

		if (!isset($config['scopes'][$scope]))
			throw new \InvalidArgumentException("Scope $scope not exists. Use 'hasScope' method to check.");
			
		if (is_string($config['scopes'][$scope]))
			return array($config['scopes'][$scope]);
			
		return $config['scopes'][$scope];
	}
	
	/*
	* @inheritdoc
	* 
	*/
	public function hasFlow($flow)
	{
		$config = $this->definition->getConfiguration();
		
		if (!isset($config['flows'][$flow]))
			return false;
			
		return true;
	}
}
