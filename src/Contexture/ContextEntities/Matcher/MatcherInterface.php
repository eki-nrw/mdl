<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Matcher;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface MatcherInterface
{
	/**
	* Checks if object $obj matched with arguments
	* 
	* @param object $obj
	* @param mixed|null $arguments
	* 
	* @return bool
	*/
	public function match($obj, $arguments = null);
}
