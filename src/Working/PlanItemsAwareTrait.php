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

//use Eki\NRW\Common\QuantityValue\QuantityValueInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait PlanItemsAwareTrait
{
	/**
	* @var PlanItemInterface[]
	*/
	private $planItems = [];

	/**
	* @inheritdoc
	*/	
	public function addPlanItem(PlanItemInterface $planItem, $key)
	{
		$this->validatePlanItem($planItem);
		
		if ($this->hasPlanItem($key))
			throw new \LogicException(sprintf('Plan Item with key %s alreay exists.', $key));
		if (in_array($planItem, array_values($this->planItems), true))
			throw new \InvalidArgumentException("Cannot add the same plan item twice.");
		
		$this->planItems[$key] = $planItem;
		
		if ($planItem instanceof HasPlanInterface and $this instanceof PlanInterface)
			$planItem->setPlan($this);
			
		return $this;
	}
	
	/**
	* Validate plan item
	* 
	* @param PlanItemInterface $planItem
	* 
	* @return void
	* @throws
	*/
	//abstract protected function validatePlanItem(PlanItemInterface $planItem);
	
	/**
	* @inheritdoc
	*/	
	public function removePlanItem(PlanItemInterface $planItem)
	{
		if (!in_array($planItem, array_values($this->planItems), true))
			throw new \InvalidArgumentException("No plan item to remove.");
			
		$planItems = $this->planItems;
		foreach($planItems as $key => $item)
		{
			if ($item === $planItem)
			{
				if ($item instanceof HasPlanInterface and $this instanceof PlanItemInterface)
					$item->setPlan();
				unset($this->planItems[$key]);
				return;
			}
		}
	}
	
	/**
	* @inheritdoc
	*/	
	public function removePlanItemByKey($key)
	{
		if (!isset($this->planItems[$key]))
			throw new \InvalidArgumentException("No plan item has key $key.");

		$planItem = $this->planItems[$key];			
		if ($planItem instanceof HasPlanInterface and $this instanceof PlanItemInterface)
			$$planItem->setPlan();
		unset($this->planItems[$key]);
	}
	
	/**
	* @inheritdoc
	*/	
	public function getPlanItem($key)
	{
		if (isset($this->planItems[$key]))
			return $this->planItems[$key];
	}
	
	/**
	* @inheritdoc
	*/	
	public function getPlanItems()
	{
		return $this->planItems;
	}
	
	/**
	* @inheritdoc
	*/	
	public function setPlanItems(array $planItems)
	{
		foreach($planItems as $key => $planItem)
		{
			if (!$planItem instanceof PlanItemInterface)
				throw new \InvalidArgumentException(sprintf(
					"One of plan items with key %s is not instance of %s. Given %s.",
					$key,
					PlanItemInterface::class,
					get_class($planItem)
				));		
		}
		
		$this->planItems = [];	
		foreach($planItems as $itemKey => $planItem)
		{
			$this->addPlanItem($planItem, $itemKey);
		}
	}
	
	/**
	* @inheritdoc
	*/	
	public function hasPlanItem($key)
	{
		return isset($this->planItems[$key]);
	}

	/**
	* @inheritdoc
	*/	
	public function getKeyOfPlanItem(PlanItemInterface $planItem)
	{
		foreach($this->planItems as $key => $pi)
		{
			if ($planItem === $pi)
				return $key;
		}
	}
}
