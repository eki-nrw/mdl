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

use Eki\NRW\Common\QuantityValue\QuantityValueInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface PlanItemsAwareInterface
{
	/**
	* Add a plan item
	* 
	* @param PlanItemInterface $planItem
	* @param string $key
	* 
	* @return void
	*/
	public function addPlanItem(PlanItemInterface $planItem, $key);
	
	/**
	* Remove a plan item
	* 
	* @param PlanItemInterface $planItem
	* 
	* @return void
	* @throws
	*/
	public function removePlanItem(PlanItemInterface $planItem);

	/**
	* Remove a plan item by key
	* 
	* @param string $key
	* 
	* @return void
	* @throws
	*/
	public function removePlanItemByKey($key);
	
	/**
	* Gets a plan item with key
	* 
	* @param string $key
	* 
	* @return PlanItemInterface
	*/
	public function getPlanItem($key);
	
	/**
	* Gets all plan items
	* 
	* @return PlanItemInterface[]
	*/
	public function getPlanItems();
	
	/**
	* Sets all plan items
	* 
	* @param PlanItemInterface[] $planItems
	* 
	* @return this
	*/
	public function setPlanItems(array $planItems);
	
	/**
	* Checks if a plan item exists
	* 
	* @param string $key
	* 
	* @return bool
	*/
	public function hasPlanItem($key);
	
	/**
	* Returns the key of the given plan item
	* 
	* @param PlanItemInterface $planItem
	* 
	* @return string
	*/
	public function getKeyOfPlanItem(PlanItemInterface $planItem);
}
