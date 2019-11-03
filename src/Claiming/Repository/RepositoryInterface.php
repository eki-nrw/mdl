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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface RepositoryInterface
{
	/**
	* Returns claim type service
	* 
	* @return ClaimTypeServiceInterface
	*/
	public function getClaimTypeService();

	/**
	* Returns claim service
	* 
	* @return ClaimServiceInterface
	*/
	public function getClaimService();
}
