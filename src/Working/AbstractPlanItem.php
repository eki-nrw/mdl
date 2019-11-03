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

use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemTrait;
use Eki\NRW\Common\Compose\ObjectItemSource\HasObjectItemSourceTrait;
use Eki\NRW\Common\Timing\TimingTrait;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesTrait;
use Eki\NRW\Common\Common\DocumentationTrait;
use Eki\NRW\Common\Common\InfoTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractPlanItem implements PlanItemInterface
{
	use 
		PlanItemCoreTrait,
		HasPlanTrait,
		HasPlanItemTypeTrait,
		HasObjectItemTrait,
		HasObjectItemSourceTrait,
		TimingTrait,
		ObjectStatesTrait,
		DocumentationTrait,
		InfoTrait
	;

	/**
	* Constructor
	* 
	* @param PlanItemTypeInterface $planItemType
	* 
	*/
	public function __construct(PlanItemTypeInterface $planItemType = null)
	{
		$this->setPlanItemType($planItemType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchPlanItemType(PlanItemTypeInterface $planItemType)
	{
	}
}

