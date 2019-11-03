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

use Eki\NRW\Mdl\Processing\Solution\SolutionInterface;
use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

use Closure;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Solution implements SolutionInterface
{
	/**
	* @var AlgorithmInterface
	*/
	protected $algorithm;
	
	/**
	* @var Closure
	*/
	protected $contextChecker;
	
	/**
	* @var Closure
	*/
	protected $stepGetter;
	
	public function __construct(AlgorithmInterface $algorithm, Closure $contextChecker = null, Closure $stepGetter = null)
	{
		$this->algorightm = $algorithm;
		$this->contextChecker = $contextChecker;
		$this->stepGetter = $stepGetter;
	}	
	
	/**
	* Determines the solution accepts the given context or not
	* 
	* @param mixed $context
	* 
	* @return bool
	* @throws
	*/
	public function accept($context)
	{
		if ($context === null)
			throw new \InvalidArgumentException("Context null is not accepted.");
			
		if (!is_array($context) and !$context instanceof ContextInterface)
			return false;

		if (null !== $this->contextChecker)
		{
			$contextChecker = $this->contextChecker;
			return $contextChecker($context);
		}
		
		return false;		
	}

	/**
	* The solution solves problem that specified by context
	* 
	* @param mixed $context
	*  
	* @return mixed
	* @throws
	*/
	public function solve($context)
	{
		if (!$this->accept($context))
			return \InvalidArgumentException("Context invalid.");
		
		if (null !== ($stepKey = $this->getStepKey($context)))
		{
			$context = $this->algorightm->run($stepKey, $context);
		}
		else
		{
			$context = $this->algorithm->run(null, $context);
		}
		
		return $context;
	}
	
	protected function getStepKey(ContextInterface $context)
	{
		if (null !== $this->stepGetter)
		{
			$stepGetter = $this->stepGetter;
			return $stepGetter($context);
		}
	}
}
