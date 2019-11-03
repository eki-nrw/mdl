<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Tests\Repository;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\ClaimTypeInterface;
use Eki\NRW\Mdl\Claiming\Claim;

use Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface;
use Eki\NRW\Mdl\Claiming\Repository\ClaimServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\ClaimTypeServiceInterface;

class ClaimServiceTest extends BaseTest
{
	public function testCreateClaim()
	{
		$claimType = "clam_type";
		
		$repository = $this->getRepository();
		$claimTypeService = $repository->getClaimTypeService();
		
		$claimTypeObj = $claimTypeService->getClaimType($claimType);
	}
}
