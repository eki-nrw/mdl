<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository\General;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\ClaimTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface PersistenceServiceInterface
{
	public function saveClaim(ClaimInterface $claim);
	
	public function loadClaim($id);

	public function loadClaimBy(array $criteria);

	public function saveClaimType(ClaimTypeInterface $claimType);
	
	public function loadClaimType($id);

	public function loadClaimTypeName($claimTypeName);

	public function loadClaimTypeBy(array $criteria);
}
