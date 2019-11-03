<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Callback\Plan;

use Eki\NRW\Mdl\Working\Subject\AbstractCallback;
use Eki\NRW\Mdl\Working\PlanInterface;
use Eki\NRW\Mdl\Working\PlanItemInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class PlanCallback extends AbstractCallback
{
	public function __construct()
	{
		parent::__construct(
			null, 
			function ($subject) {
				if (!$subject instanceof PlanInterface)
					throw new \InvalidArgumentException(sprintf(
						"Invalid subject. It must be instance of %s. Given %s.",
						PlanInterface::class, get_class($subject)
					));
			}
		);
	}
	
	/**
	* @inheritdoc
	*/
	public function getCallbackType()
	{
		return 'plan';
	}

	/**
	* @inheritdoc
	*/
	/*
	protected function validateAssignSubject($subject)
	{
		if (!$subject instanceof PlanInterface)
			throw new \InvalidArgumentException(sprintf(
				"Invalid subject. It must be instance of %s. Given %s.",
				PlanInterface::class, get_class($subject)
			));
	}
	*/
	
	/**
	* Get plan
	* 
	* @return PlanInterface
	*/
	protected function getPlan()
	{
		return $this->getSubject();
	}
	
	/**
	* @internal
	*/
	protected function addPlanItem($type, $data)
	{
		// use $type as $key of plan item
		
		return $this->getPlan()->addPlanItem($data, $type);
	}

	/**
	* @internal
	*/
	protected function addPlanItemSupport($type, $data)
	{
		return $data instanceof PlanItemInterface;
	}
}
