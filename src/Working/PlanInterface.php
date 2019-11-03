<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesInterface;
use Eki\NRW\Common\Common\DocumentationInterface;
use Eki\NRW\Common\Common\InfoInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface PlanInterface extends
	HasPlanTypeInterface,
	PlanItemsAwareInterface,
	TimingInterface,
	ResponsibilitiesAwareInterface,
	ObjectStatesInterface,
	DocumentationInterface,
	InfoInterface
{
	/**
	* Returns the name of plan
	* 
	* @return string
	*/
	public function getPlanName();
	
	/**
	* Ses the name of plan
	* 
	* @param string $name
	* 
	* @return void
	*/
	public function setPlanName($name);
	
	/**
	* Returns the objective of the plan
	* 
	* @return mixed
	*/
	public function getObjective();
	
	/**
	* Sets an objective
	* 
	* @param mixed $objective
	* 
	* @return void
	*/
	public function setObjective($objective);

	/**
	* Returns the solution
	* 
	* @return mixed
	*/	
	public function getSolution();
	
	/**
	* Sets solution
	* 
	* @param mixed $solution
	* 
	* @return void
	*/
	public function setSolution($solution);

}
