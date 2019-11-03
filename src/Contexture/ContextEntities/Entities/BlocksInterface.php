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

use Eki\NRW\Mdl\Contexture\ContextEntities\Scope\ScopeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface BlocksInterface
{
	/**
	* Returns the boundary
	* 
	* @return object
	*/
	public function getBoundary();
	
	/**
	* Sets boundary
	* 
	* @param object $boundary
	* 
	* @return this
	*/
	public function setBoundary($boundary);
	
	/**
	* Returns all scopes in the boundary
	* 
	* @return array Array of scopes, every scope has levels
	*/
	public function getScopes();
	
	/**
	* Get entities 
	* 
	* @param string|null $scope Null if all scopes
	* @param string|null $level Null if all levels
	* 
	* @return object[][]
	*/
	public function getEntities($scope = null, $level = null);
	
	/**
	* Checks if the blocks that has the given entity
	* 
	* @param object $entity
	* @param string|null $scope Null if all scopes
	* @param string|null $level Null if all levels
	* 
	* @return bool
	*/
	public function hasEntity($entity, $scope = null, $level = null);
	
	/**
	* Gets all scopes the given entity belongs to 
	* 
	* @param object $entity
	* 
	* @return ScopeInterface[]
	*/
	public function getEntityScopes($entity);
}
