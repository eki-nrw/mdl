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

use Eki\NRW\Mdl\REA\Agent\AgentInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Association extends Relationship implements AssociationInterface
{
	public function __construct(
		$type = Constants::REA_RELATIONSHIP_MAIN_TYPE_DEFAULT, 
		$subType = Constants::REA_RELATIONSHIP_SUB_TYPE_DEFAULT,
		$label = '', $value = null
	)
	{
		parent::__construct(Constants::REA_RELATIONSHIP_ASSOCIATION, $type, $subType, $label, $value);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getAgent()
	{
		return $this->getObject();
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getOtherAgent()
	{
		return $this->getOtherObject();
	}

	/**
	* Validate object assigned to node
	* 
	* @param object $obj
	* 
	* @throws \InvalidArgumentException
	*/
	protected function validateObject($obj)
	{
		if (!$obj instanceof AgentInterface)
			throw new \InvalidArgumentException(sprintf("Node has object that is not instance of %s.", AgentInterface::class));
	}

	/**
	* Validate object assigned to other node
	* 
	* @param object $obj
	* 
	* @throws \InvalidArgumentException
	*/
	protected function validateOtherObject($obj)
	{
		if (!$obj instanceof AgentInterface)
			throw new \InvalidArgumentException(sprintf("Other Node has object that is not instance of %s.", AgentInterface::class));
    }
}
