<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Entities;

use Eki\NRW\Mdl\Contexture\ContextEntities\Context\ContextInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
class Blocks implements BlocksInterface
{
	/**
	* @var object
	*/
	private $boundary;
	
	/**
	* 
	* @var ContextInterface
	* 
	*/
	protected $context;
	
	/**
	* @var EntitiesGetterInterface
	*/
	protected $entitiesGetter;

	/**
	* Constructor
	* 
	* @param ContextInterface $context
	* @param EntitiesGettterInterface $getter
	* 
	*/
	public function __construct(
		ContextInterface $context, 
		EntitiesGetterInterface $getter
	)
	{
		$this->context = $context;
		$this->entitiesGetter = $getter;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getBoundary()
	{
		return $this->boundary;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setBoundary($boundary)
	{
		if (!is_object($boundary))
			throw new \InvalidArgumentException("Parameter 'boundary' must be an object.");
			
		if (!$this->context->acceptBoundary($boundary))
			throw new \InvalidArgumentException("Boundary object cannot be accepted in context.");
			
		$this->boundary = $boundary;
		
		return $this;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getScopes()
	{
		return $this->context->getScopes();
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getEntities($scope = null, $level = null)
	{
		$_scopes = $this->getScopes();
		
		if ($scope !== null)
		{
			if ($level === null)
			{
				if (!isset($_scopes[$scope]))
					return array();
					
				$_scopes = array($scope => $_scopes[$scope]);
			}
			else			
			{
				if (!isset($_scopes[$scope][$level]))
					return array();
					
				$_scopes = array( 
					$scope => array( 
						$level => null
					) 
				);
			}
		}
		
		$entities = array();
		foreach($_scopes as $_key_scope => $_scope)
		{	
			$entities[$_key_scope] = array();
			foreach($_scope as $_key_level => $_level)
			{
				$entities[$_key_scope][$_key_level] = array();
				foreach($this->entitiesGetter->getEntities($this->boundary, $_key_scope, $_key_level) as $entity)
				{
					$entities[$_key_scope][$_key_level][] = $entity;
				}
			}
		}

		return $entities;
	}

	/**
	* Checks if the blocks that has the given entity
	* 
	* @param object $entity
	* 
	* @return bool
	*/
	public function hasEntity($entity, $scope = null, $level = null)
	{
		foreach($this->getEntities($scope, $level) as $sc => $levelObjects)
		{
			foreach($levelObjects as $obj)
			{
				if ($entity === $obj)
					return true;
			}
		}
		
		return false;
	}
	
	/**
	* Gets all scopes the given entity belongs to 
	* 
	* @param object $entity
	* 
	* @return array
	*/
	public function getEntityScopes($entity)
	{
		$ret = array();
		foreach($this->entitiesGetter->getEntities($this->boundary) as $scope => $levelEntities)
		{
			$ret[$scope] = array();
			foreach($levelEntities as $level => $ent)
			{
				if ($entity === $ent)
				{
					$ret[$scope][] = $level;
				}
			}	
		}
		
		return $ret;
	}
}
