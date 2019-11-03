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

use Eki\NRW\Mdl\Processing\Solution\Solution\DelegateSolution as BaseDelegateSolution;
use Eki\NRW\Mdl\Processing\Solution\SolutionInterface;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;
use Eki\NRW\Mdl\Processing\Solution\Context\Context;

use Closure;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class DelegateSolution extends BaseDelegateSolution
{
	public function __construct(
		ContextInterface $context,
		AlgorithmInterface $algorithm, 
		Closure $contextChecker = null, 
		Closure $stepGetter = null, 
	)
	{
		parent::__construct($context, new Solution($algorithm, $contextChecker, $stepGetter));
	}	

}
