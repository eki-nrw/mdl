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

use Eki\NRW\Mdl\Processing\Solution\Context\ContextInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Algorithm implements AlgorithmInterface
{
	/**
	* @var array
	*/
	protected $rules = [];
	
	/**
	* @var StepInterface[]
	*/
	protected $steps = [];
	
	public function __construct(array $rules = [], array $steps = [])
	{	
		$this->setRules($rules);
	
		foreach($steps as $step)
		{
			if (!$step instanceof StepInterface)
				throw new \InvalidArgumentException(sprintf(
					"Step with index $stepNo must be instance of %s. Given %s.",
					StepInterface::class,
					get_class($step)
				));
			
			$key = $step->getKey();
			if (null === $key)
				$key = spl_object_hash($step);
			$step->setAlgorightm($this);	
			$this->steps[$key] = $step;
		}
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function run($key, ContextInterface $context)
	{
		if (null !== $key and isset($this->steps[$key]))
		{
			return $this->steps[$key]->run($context);
		}
		else
		{
			foreach($this->steps as $step)
			{
				$contex = $step->run($context);
			}
			
			return $context;
		}
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setRules(array $rules)
	{
		$this->rules = $rules;
		
		return $this;	
	}
	
	/**
	* Returns all rules
	* 
	* @return array
	*/
	public function getRules()
	{
		return $this->rules;
	}
}
