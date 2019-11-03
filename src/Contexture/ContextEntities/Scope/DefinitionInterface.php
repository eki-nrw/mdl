<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Scope;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\DefinitionInterface as BaseDefinitionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface DefinitionInterface extends BaseDefinitionInterface
{
	/**
	* Sets scope
	* 
	* @param string $scopeValue
	* 
	* @return this
	*/
	public function setScope($scopeValue);
	
	/**
	* Return the scope
	* 
	* @return string
	*/
	public function getScope();
	
	/**
	* Sets level
	* 
	* @param string $levelName
	* @param string|null $levelValue
	* 
	* @return this
	*/
	public function setLevel($levelName, $levelValue);

	/**
	* Returns level value by level name
	* 
	* @param string $levelName
	* 
	* @return string
	*/
	public function getLevel($levelName);

	/**
	* Sets all levels
	* 
	* @param array $levels
	* 
	* @return this
	*/
	public function setLevels(array $levels);
	
	/**
	* Returns levels
	* 
	* @return string[]
	*/
	public function getLevels();
}
