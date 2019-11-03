<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Provider;

use Eki\NRW\Mdl\Processing\Solution\SolutionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface RegistryInterface
{
	/**
	* Returns the solution
	* 
	* @return SolutionInterface
	*/
	public function getSolution();

	/**
	* Checks if the input $arguments matches to the registry
	* 
	* @param mixed $arguments
	* 
	* @return bool
	*/
	public function match($arguments);
}
