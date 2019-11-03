<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Relationship;

use Eki\NRW\Mdl\REA\Event\EventInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Duality extends Relationship implements DualityInterface
{
	public function __construct(
		$type = Constants::REA_RELATIONSHIP_MAIN_TYPE_DEFAULT, 
		$subType = Constants::REA_RELATIONSHIP_SUB_TYPE_DEFAULT,
		$label = '', $value = null
	)
	{
		parent::__construct(Constants::REA_RELATIONSHIP_DUALITY, $type, $subType, $label, $value);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getEvent()
	{
		return $this->getObject();
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getOtherEvent()
	{
		return $this->getOtherObject();
	}

	/**
	* @inheritdoc
	* 
	*/
	protected function validateObject($obj)
	{
		if (!$obj instanceof EventInterface)
			throw new \InvalidArgumentException(sprintf("Node has object that is not instance of %s.", EventInterface::class));
	}

	/**
	* @inheritdoc
	* 
	*/
	protected function validateOtherObject($obj)
	{
		if (!$obj instanceof EventInterface)
			throw new \InvalidArgumentException(sprintf("Other Node has object that is not instance of %s.", EventInterface::class));
    }
}
