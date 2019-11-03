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
use Eki\NRW\Mdl\REA\Resource\ResourceInterface;

/**
* Stockflow is relationship between resource and event
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface StockflowInterface extends RelationshipInterface
{
	/**
	* Returns the resource
	* 
	* @return ResourceInterface
	*/
	public function getResource();
	
	/**
	* Returns the event
	* 
	* @return EventInterface
	*/
	public function getEvent();
	
	/**
	* Get the direction of stofkflow
	* 
	* @return string
	*/
	public function getDirection();
	
	/**
	* Returns the method
	* 
	* @return string
	*/
	public function getMethod();
}
