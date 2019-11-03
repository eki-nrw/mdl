<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Flow;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\DefinitionInterface as BaseDefinitionInterface;

/**
* Data flow Definition
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface DefinitionInterface extends BaseDefinitionInterface
{
	/**
	* Sets the flow
	* 
	* @param string $flow
	* 
	* @return this
	*/
	public function setFlow($flow);
	
	/**
	* Return the flow
	* 
	* @return string
	*/
	public function getFlow();
	
	/**
	* Sets from scope
	* 
	* @param string $scope
	* @param string|null $level
	* 
	* @return this
	*/
	public function setFromScope($scope, $level = null);
	
	/**
	* Return 'from' scope/level
	* 
	* @return string
	*/
	public function getFromScope();
	
	/**
	* Sets to scope
	* 
	* @param string $scope
	* @param string|null $level
	* 
	* @return
	*/
	public function setToScope($scope, $level = null);

	/**
	* Return 'to' scope/level
	* 
	* @return string
	*/
	public function getToScope();
}
