<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository\General\InMemory;

use Eki\NRW\Mdl\Claiming\Repository\General\PersistenceServiceInterface;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\Set\ClaimSetInterface;
use Eki\NRW\Mdl\Claiming\ClaimTypeInterface;

use Eki\NRW\Common\Testing\Repository\InMemoryRepository;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class PersistenceService implements PersistenceServiceInterface
{
	/**
	* @var InMemoryRepository
	*/
	private $claimRepository;

	/**
	* @var InMemoryRepository
	*/	
	private $claimTypeRepository;
	
	public function __construct()
	{
		$this->claimRepository = new InMemoryRepository(ClaimInterface::class);
		$this->claimTypeRepository = new InMemoryRepository(ClaimTypeInterface::class);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function saveClaim(ClaimInterface $claim)
	{
		$this->claimRepository->add($claim);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function loadClaim($id)
	{
		$claim = $this->claimRepository->find($id);
		
		if ($claim instanceof ClaimSetInterface)
		{
			foreach($claim->setIterator() as $key => $itemClaim)
			{
				//....
			}
						
		}
		
		return $claim;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function loadClaimBy(array $criteria)
	{
		return $this->claimRepository->findBy($criteria);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function saveClaimType(ClaimTypeInterface $claimType)
	{
		$this->claimTypeRepository->add($claimType);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function loadClaimType($id)
	{
		return $this->claimTypeRepository->find($id);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function loadClaimTypeName($claimTypeName)
	{
		return $this->claimTypeRepository->findBy(
			array(
				'type' => $claimTypeName
			)
		);
	}
	

	/**
	* @inheritdoc
	* 
	*/
	public function loadClaimTypeBy(array $criteria)
	{
		return $this->claimTypeRepository->findBy($criteria);
	}
	
	public function findClaims(array $criteria)
	{
		return $this->claimRepository->findBy($criteria);
	}
}
