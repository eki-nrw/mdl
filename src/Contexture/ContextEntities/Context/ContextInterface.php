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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface ContextInterface extends HasDefinitionInterface
{
	/**
	* Returns the name of the context
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Checks if the boundary is accepted
	* 
	* @param object $boundary
	* 
	* @return bool
	*/
	public function acceptBoundary($boundary);
	
	/**
	* Checks if the entity is supported in $scope at $level
	* 
	* @param object $entity
	* @param string|null $scope
	* @param string|null $level
	* 
	* @return bool
	*/
	public function supportEntity($entity, $scope = null, $level = null);

	/**
	* Checks if the scopes are valid
	* 
	* @param string $scope
	* @param string|null $level
	* 
	* @throw \InvalidArgumentException 
	* 
	* @return bool
	*/
	public function hasScope($scope, $level = null);
	
	/**
	* Returns all scopes in the context
	* 
	* @return array Array of scopes, every scope has the levels
	*/
	public function getScopes();

	/**
	* Returns all levels of the given scope
	* 
	* @param string $scope
	* 
	* @return array
	*/
	public function getLevels($scope);

	/**
	* Checks if the flows are valid
	* 
	* @param string $flow
	* 
	* @return bool
	*/
	public function hasFlow($flow);
	
	/**
	* Extract to the context defined by scopes, flows (optional), use cases (optional)
	* 
	* @param string|array $scopes
	* @param string|array|null $flows
	* @param string|array|null $uses
	* 
	* @return ContextInterface
	*/
	//public function extract($scopes, $flows = null, $uses = null);
}
