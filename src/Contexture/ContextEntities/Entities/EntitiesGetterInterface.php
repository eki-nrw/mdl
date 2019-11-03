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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface EntitiesGetterInterface
{
	/**
	* Get entities of the given boundary
	* 
	* @param object $boundary
	* @param string $scope
	* @param string $level
	* 
	* @return object[]
	* 
	*/
	public function getEntities($boundary, $scope, $level);
}
