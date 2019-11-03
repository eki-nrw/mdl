<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is delivery to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Claimable;

use Eki\NRW\Mdl\Claiming\DeliverableInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Deliverable implements DeliverableInterface
{
	/**
	* @var mixed
	*/
	private $delivery;
	
	/**
	* Constructor
	* 
	* @param mixed $delivery
	* 
	*/
	public function __construct($delivery)
	{
		$this->setDelivery($delivery);		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getDelivery()
	{
		return $this->delivery;		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function setDelivery($delivery = null)
	{
		$this->delivery = $delivery;		
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function deliver($info)
	{
		// default is nothing		
	}
}
