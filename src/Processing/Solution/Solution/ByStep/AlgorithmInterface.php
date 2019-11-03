<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Solution\ByStep;

use Eki\NRW\Mdl\Processing\Solution\AlgorithmInterface as BaseAlgorithmInterface;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface AlgorithmInterface extends BaseAlgorithmInterface
{
	/**
	* Sets the rules of the algorithm
	* 
	* @param mixed $rules
	* 
	* @return this
	*/
	public function setRules(array $rules);
	
	/**
	* Returns all rules
	* 
	* @return array
	*/
	public function getRules();
}
