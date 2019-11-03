<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Solution\Solution;

use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface AlgorithmInterface
{
	/**
	* Run by key
	* 
	* @param int|string|null $key
	* @param mixed $context
	* 
	* @return mixed Return context
	*/
	public function run($key, ContextInterface $context);
}
