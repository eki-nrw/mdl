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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface ScopeInterface
{
	/**
	* Returns the name's of the scope
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Returns the scope
	* 
	* @return string|array If string, returned value is the value of the scope
	*/
	public function getScope();
	
	/**
	* Returns the levels of the scope
	* 
	* @return array
	*/
	public function getLevels();
	
	/**
	* Returns the level value
	* 
	* @param string $levelName
	* 
	* @return string
	*/
	public function getLevel($levelName);
}
