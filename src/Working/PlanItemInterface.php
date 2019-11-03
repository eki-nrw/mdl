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

use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemInterface;
use Eki\NRW\Common\Compose\ObjectItemSource\HasObjectItemSourceInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesInterface;
use Eki\NRW\Common\Common\DocumentationInterface;
use Eki\NRW\Common\Common\InfoInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface PlanItemInterface extends
	HasPlanItemTypeInterface,
	HasObjectItemInterface,			// result of plan item
	HasObjectItemSourceInterface,   //source of plan item
	TimingInterface,
	HasPlanInterface,
	ObjectStatesInterface,
	DocumentationInterface,
	InfoInterface
{
	/**
	* Returns the name of item
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Sets the name of item
	* 
	* @param string $name
	* 
	* @return void
	*/
	public function setName($name);

	/**
	* Returns order number in item list
	* 
	* @return int
	*/
	public function getPriority();
	
	/**
	* Sets order number in item list
	* 
	* @param int $priority
	* 
	* @return void
	*/
	public function setPriority($priority);
}
