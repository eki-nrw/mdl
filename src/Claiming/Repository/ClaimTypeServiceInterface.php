<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository;

use Eki\NRW\Mdl\Claiming\ClaimTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ClaimTypeServiceInterface
{
	/**
	* Register a clain type by definition
	* 
	* @param string $claimType
	* @param mixed $definition
	* 
	* @return void
	* 
	* @throw
	*/
	public function registerClaimType($claimType, $definition);
	
	/**
	* Get claim type
	* 
	* @param string $claimType
	* 
	* @return \Eki\NRW\Mdl\Claiming\ClaimTypeInterface
	*/
	public function getClaimType($claimType);
}
