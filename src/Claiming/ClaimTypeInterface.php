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

use Eki\NRW\Mdl\Model\HasDefinitionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ClaimTypeInterface extends 
	HasDefinitionInterface
{
	/**
	* Returns claim type
	* 
	* @return string
	*/
	public function getType();

	/**
	* Fullfill claim
	* 
	* @param ClaimInterface $claim
	* 
	* @return void
	*/	
	public function fullfill(ClaimInterface $claim);
}
