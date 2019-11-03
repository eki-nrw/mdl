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

use Eki\NRW\Common\Relations\Relationship\Relationship as BaseRelationship;
use Eki\NRW\Common\Relations\NodeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Relationship extends BaseRelationship implements RelationshipInterface
{
	public function __construct($reaType, $mainType = '', $subType = '', $label = '', $value = null)
	{
		parent::__construct(
			$this->composeTypes(Constants::REA_DOMAIN, $reaType, $mainType, $subType),
			$label, 
			$value
		);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function setNode(NodeInterface $node = null)
	{
		if ($node !== null and null !== ($obj = $node->getObject()))
		{
			$this->validateObject($obj);
		}
		
		return parent::setNode($node);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function setOtherNode(NodeInterface $otherNode = null)
	{
		if ($otherNode !== null and null !== ($obj = $otherNode->getObject()))
		{
			$this->validateOtherObject($obj);
		}

		return parent::setOtherNode($otherNode);
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
		// Ex.:
		//  if (!$obj instanceof <class_name>)
		//	  throw new \InvalidArgumentException(sprintf("Node has object that is not instance of %s.", <class_name>::class	
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
		// Ex.:
		//  if (!$obj instanceof <class_name>)
		//	  throw new \InvalidArgumentException(sprintf("Other Node has object that is not instance of %s.", <class_name>::class
    }
}  
