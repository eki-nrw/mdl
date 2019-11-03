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

use Eki\NRW\Mdl\REA\Resource\ResourceInterface;
use Eki\NRW\Mdl\REA\Event\EventInterface;
use Eki\NRW\Common\Relations\TypeMeaningInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Stockflow extends Relationship implements StockflowInterface
{
	const DIRECTION_NONE = "none";
	
	const INDEX_DIRECTION = TypeMeaningInterface::INDEX_MAIN_TYPE;
	const INDEX_METHOD = TypeMeaningInterface::INDEX_SUB_TYPE;

	public function __construct(
		$direction = self::DIRECTION_NONE, 
		$method = '',
		$label = '', $value = null
	)
	{
		parent::__construct(Constants::REA_RELATIONSHIP_STOCKFLOW, $direction, $method, $label, $value);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getEvent()
	{
		return $this->getOtherObject();
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getResource()
	{
		return $this->getObject();
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getMethod()
	{
		return $this->getSubType();
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getDirection()
	{
		return $this->getMainType();
	}

	/**
	* @inheritdoc
	* 
	*/
	protected function validateObject($obj)
	{
		if (!$obj instanceof ResourceInterface)
			throw new \InvalidArgumentException(sprintf("Node has object that is not instance of %s.", ResourceInterface::class));
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
