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
interface SolutionInterface
{
	/**
	* Determines the solution accepts the given context or not
	* 
	* @param mixed $context
	* 
	* @return bool
	*/
	public function accept($context);

	/**
	* The solution solves problem that specified by context
	* 
	* @param mixed $context
	*  
	* @return void
	* @throws
	*/
	public function solve($context);	
}
