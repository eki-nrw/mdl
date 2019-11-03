<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subjectable to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

use Eki\NRW\Mdl\Claiming\ClaimableInterface;
use Eki\NRW\Mdl\Claiming\SubjectableInterface;
use Eki\NRW\Mdl\Claiming\OriginableInterface;
use Eki\NRW\Mdl\Claiming\DeliverableInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Claimable implements ClaimableInterface
{
	/**
	* @var SubjectableInterface
	*/
	private $subjectable;
	
	/**
	* @var OriginableInterface
	*/
	private $originable;

	/**
	* @var DeliverableInterface
	*/
	private $deliverable;
	
	public function __construct(
		SubjectableInterface $subjectable = null,
		OriginableInterface $originable = null,
		DeliverableInterface $deliverable = null
	)
	{
		$this->subjectable = $subjectable;
		$this->originable = $originable;
		$this->deliverable = $deliverable;
	}
	
	/**
	* @inheritdoc
	*/
	public function getSubjectable()
	{
		return $this->subjectable;
	}
	
	/**
	* @inheritdoc
	*/
	public function setSubjectable(SubjectableInterface $subjectable = null)
	{
		$this->subjectable = $subjectable;
	}

	/**
	* @inheritdoc
	*/
	public function getOriginable()
	{
		return $this->originable;
	}
	
	/**
	* @inheritdoc
	*/
	public function setOriginable(OriginableInterface $originable = null)
	{
		$this->originable = $originable;
	}

	/**
	* @inheritdoc
	*/
	public function getDeliverable()
	{
		return $this->deliverable;
	}
	
	/**
	* @inheritdoc
	*/
	public function setDeliverable(DeliverableInterface $deliverable = null)
	{
		$this->deliverable = $deliverable;
	}
}
