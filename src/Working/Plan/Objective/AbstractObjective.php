<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Plan\Objective;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractObjective implements ObjectiveInterface
{
	private $goal;
	private $outcome;
	
	/**
	* Returns the goal
	* 
	* @return mixed
	*/
	public function getGoal()
	{
		return $this->goal;
	}
	
	/**
	* Sets the goal
	* 
	* @param mixed $goal
	* 
	* @return void
	*/
	public function setGoal($goal = null)
	{
		if (!$this->acceptGoal($goal))
			throw new \InvalidArgumentException("Goal invalid.");
		
		$this->goal = $goal;
	}
	
	/**
	* Returns the outcome
	* 
	* @return mixed
	*/
	public function getOutcome()
	{
		return $this->outcome;
	}
	
	/**
	* Sets the outcome
	* 
	* @param mixed $outcome
	* 
	* @return void
	*/
	public function setOutcome($outcome)
	{
		if (null === $this->getGoal())
			throw new \LogicException("The goal must be determined first.");	
			
		if (!$this->matchOutcome($outcome))
			throw new \InvalidArgumentException("Outcome is not matched the goal.");
			
		$this->outcome = $outcome;
	}
}
