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
use Eki\NRW\Common\Timing\TimingTrait;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractActivity implements ActivityInterface
{
	use
		HasActivityTypeTrait,
		HasObjectItemTrait,
		ResponsibilitiesAwareTrait,
		TimingTrait,
		ObjectStatesTrait
	;

	/**
	* @var string
	*/
	private $name;

	/**
	* Constructor
	* 
	* @param ActivityTypeInterface|null $activityType
	* 
	*/
	public function __construct(ActivityTypeInterface $activityType = null)
	{
		$this->setActivityType($activityType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchActivityType(ActivityTypeInterface $activityType)
	{
	}

	/**
	* @inheritdoc
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* @inheritdoc
	*/
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
}
