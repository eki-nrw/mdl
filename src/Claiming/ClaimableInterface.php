<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ClaimableInterface
{
	/**
	* Return subjectable
	* 
	* @return SubjectableInterface
	*/
	public function getSubjectable();
	
	/**
	* Sets subjectable
	* 
	* @param SubjectableInterface $subjectable
	* 
	* @return void
	*/
	public function setSubjectable(SubjectableInterface $subjectable = null);

	/**
	* Returns originable
	* 
	* @return OriginableInterface
	*/
	public function getOriginable();
	
	/**
	* Sets originable
	* 
	* @param OriginableInterface $originable
	* 
	* @return void
	*/
	public function setOriginable(OriginableInterface $originable = null);
	
	/**
	* Returns deliverable
	* 
	* @return DeliverableInterface
	*/
	public function getDeliverable();
	
	/**
	* Sets deliverable
	* 
	* @param DeliverableInterface $deliverable
	* 
	* @return void
	*/
	public function setDeliverable(DeliverableInterface $deliverable = null);
}
