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
interface ObjectiveInterface
{
	/**
	* Returns the goal
	* 
	* @return mixed
	*/
	public function getGoal();
	
	/**
	* Sets the goal
	* 
	* @param mixed|null $goal Null if reset goal
	* 
	* @return void
	* 
	* @throws \InvalidArgumentException
	*/
	public function setGoal($goal = null);
	
	/**
	* Returns the outcome
	* 
	* @return mixed
	*/
	public function getOutcome();
	
	/**
	* Sets the outcome
	* 
	* @param mixed $outcome
	* 
	* @return void
	* 
	* @throw \LogicException
	* @throw \InvalidArgumentException
	*/
	public function setOutcome($outcome);
	
	/**
	* Checks if the goal is valid
	* 
	* @param mixed $goal
	* 
	* @return bool
	*/
	public function acceptGoal($goal);
	
	/**
	* Checks if the outcome matches the goal
	* 
	* @param mixed $outcome
	* 
	* @return bool
	*/
	public function matchOutcome($outcome);
}
