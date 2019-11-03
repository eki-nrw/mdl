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

use Eki\NRW\Mdl\Claiming\Repository\ClaimServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\ClaimTypeServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\ClaimTypeService;
use Eki\NRW\Mdl\Claiming\Repository\General\ClaimService;
use Eki\NRW\Mdl\Claiming\Repository\General\FindServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\PersitenceServiceInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Repository implements RepositoryInterface
{
	/**
	* @var ClaimTypeServiceInterface
	*/
	private $claimTypeService; 

	/**
	* @var ClaimServiceInterface
	*/
	private $claimService; 
	
	/**
	* @var FindServiceInterface
	*/
	private $findService;
	
	/**
	* @var PersistenceServiceInterface
	*/
	private $persistenceService;
	
	/**
	* @var DispatcherInterface
	*/
	private $dispatcher;

	/**
	* Constructor
	* 
	* @param PerssitenceServiceInterface $persistenceService
	* @param FindServiceInterface $findService
	* @param DispatcherInterface $dispatcher
	* 
	*/
	public function __construct(
		PersistenceServiceInterface $persistenceService,
		FindServiceInterface $findService,
		DispatcherInterface $dispatcher = null
	)
	{
		$this->persistenceService = $persistenceService;
		$this->findService = $findService;
		$this->dispatcher = $dispatcher;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getClaimTypeService()
	{
		if ($this->claimTypeService === null)
		{
			$this->claimTypeService = new ClaimTypeService($this);
		}
		
		return $this->claimTypeService;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getClaimService()
	{
		if ($this->claimService === null)
		{
			$this->claimService = new ClaimService($this, $this->dispatcher);
		}
		
		return $this->claimService;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getFindService()
	{
		return $this->findService;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getPersistenceService()
	{
		return $this->persistenceService;
	}
}
