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
interface ProviderInterface
{
	/**
	* Provide the appropriate solution
	* 
	* @param mixed $arguments 
	* 
	* @return SolutionInterface|null
	*/
	public function provide($arguments);

	/**
	* List all providers that match the criteria
	* 
	* @param mixed $arguments 
	* 
	* @return SolutionInterface[]
	*/	
	public function listing($arguments);
}
