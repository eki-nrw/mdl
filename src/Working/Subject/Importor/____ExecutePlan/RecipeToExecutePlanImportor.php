<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Importor\ExecutePlan;

use Eki\NRW\Mdl\Working\PlanInterface;
use Eki\NRW\Mdl\Working\ResponsibilityInterfaceInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class RecipeToExecutePlanImportor extends ToExecutePlanImportor
{
	/**
	* @inheritdoc
	*/
	protected function supportData($data)
	{
		if ($data instanceof PlanInterface)
		{
			$recipePlan = $data;
			
			if (null === ($recipePlanType = $recipePlan->getPlanType()))
				return false;
				
			if (!$recipePlanType->is('recipe'))
				return false;
				
			return true;
		}
		
		return false;
	}
	
	protected function _import(PlanInterface $recipePlan, PlanInterface &$executePlan, array $contexts)
	{
		$executePlanResponsibilities = [];
		foreach($recipePlan->getResponsibilities() as $responsibility)
		{
			if (null !== ($resp = $this->processResponsibility($responsibility)))
				$executePlanResponsibilities[] = $resp;	
		}
		
		$executePlan->setResponsibilities($executePlanResponsibilities);
	}

	/**
	* Process responsibility
	* 
	* @param ResponsibilityInterface $responsibility
	* 
	* @return ResponsibilityInterface
	*/	
	protected function processResponsibility(ResponsibilityInterface $responsibility)
	{
		return $responsibility;
	}
}
