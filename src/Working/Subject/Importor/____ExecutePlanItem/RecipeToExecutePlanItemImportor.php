<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Importor\ExecutePlanItem;

use Eki\NRW\Mdl\Working\PlanItemInterface;
use Eki\NRW\Mdl\Working\Recipe\AttainmentInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class RecipeToExecutePlanItemImportor extends ToExecutePlanItemImportor
{
	/**
	* @var AttainmentInterface
	*/
	protected $attainment;

	public function setAttainment(AttainmentInterface $attainment)
	{
		$this->attainment = $attainment;		
	}

	/**
	* @inheritdoc
	*/
	public function supportData($data)
	{
		if ($data instanceof PlanItemInterface)
		{
			$recipePlanItem = $data;
			
			if (null === ($recipePlanItemType = $recipePlanItem->getPlanItemType()))
				return false;
				
			if (!$recipePlanItemType->is('recipe'))
				return false;
				
			return true;
		}
		
		return false;
	}

	/**
	* @inheritdoc
	*/	
	protected function _prepareContexts(array $contexts)
	{
		$_contexts = $contexts;
		if (!isset($_contexts['attainment']) and null !== $this->attainment)
			$_contexts['attainment'] = $this->attainment;

		return $_contexts;
	}

	protected function _import(PlanItemInterface $recipePlanItem, PlanItemInterface &$executePlanItem, array $contexts)
	{
		$attainment = $contexts['attainment'];
		if (false === $attainment->support($recipePlanItem, $executePlanItem))
			throw new \InvalidArgumentException("Attainment don't support recipe and execute plan item");

		$attainment->doAttainment($recipePlanItem, $executePlanItem, $contexts);
	}
}
