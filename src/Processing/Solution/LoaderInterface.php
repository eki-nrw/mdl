<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface LoaderInterface
{
	/**
	* Load the solution with the given identifier
	* 
	* @param string $identifier
	* 
	* @return SolutionInterface
	*/
	public function loadByIdentifier($identifier);
	
	/**
	* Load the solution with the given context
	* 
	* @param mixed $context
	* 
	* @return SolutionInterface
	*/
	public function loadByContext(Context $context);
}
