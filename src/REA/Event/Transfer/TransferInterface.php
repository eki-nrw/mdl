<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Exchange\Event\Transfer;

use Eki\NRW\Mdl\REA\Event\EventInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface TransferInterface
{
	/**
	* Returns transfer name
	* 
	* @return string
	*/
	public function getTransferName();

	/**
	* Sets transfer name
	* 
	* @param string $transferName
	* 
	* @return void
	*/
	public function setTransferName($transferName);
	
	/**
	* Returns provide event
	* 
	* @return EventInterface
	*/
	public function getProvideEvent();
	
	/**
	* Sets provide event
	* 
	* @param EventInterface $event
	* 
	* @return void
	* @throws
	*/
	public function setProvideEvent(EventInterface $event);
	
	/**
	* Returns receive event
	* 
	* @return EventInterface
	*/
	public function getReceiveEvent();
	
	/**
	* Sets receive event
	* 
	* @param EventInterface $event
	* 
	* @return void
	* @throws
	*/
	public function setReceiveEvent(EventInterface $event);
	
	/**
	* Set transfer is reciprocal
	* 
	* @param bool $reciprocal
	* 
	* @return void
	*/
	public function setReciprocal($reciprocal = true);
	
	/**
	* Checks if transfer is reciprocal
	* 
	* @return bool
	*/
	public function isReciprocal();
}

