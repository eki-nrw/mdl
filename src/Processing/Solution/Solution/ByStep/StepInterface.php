<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\ByStep;

use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface StepInterface
{
	/**
	* Returns the key of step
	* 
	* @return string
	*/
	public function getKey();
	
	/**
	* Run this step
	* 
	* @param Context $context
	* 
	* @return ContextInterface
	*/
	public function run(ContextInterface $context);
	
	/**
	* Sets algorithm
	* 
	* @param AlgorithmInterface $algorithm
	* 
	* @return void
	*/
	public function setAlgorithm(AlgorithmInterface $algorithm);
	
	/**
	* Returns algorithm
	* 
	* @return AlgorithmInterface
	*/
	public function getAlgorithm();
}
