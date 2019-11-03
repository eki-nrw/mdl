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
use Eki\NRW\Mdl\Model\DefinitionInterface;
use Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ClaimTypeService implements ClaimTypeServiceInterface
{
	/**
	* @var \Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface
	*/
	private $repository;

	public function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	protected function getRepository()
	{
		return $this->repository;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function registerClaimType($claimType, DefinitionInterface $definition)
	{
		$persistenceService = $this->repository->getPersistenceService();
		
		try 
		{
			$persistenceService->loadClaimTypeByName($claimType);
			
			throw new \InvalidArgumentException("Claim type $claimType already registered.");
		}
		catch(\Exception $e)
		{
			//... continue
		}
		
		$procesedTerms = $definition->processMeaning(
			array(
				'type' => array(
					'class' => null
				)
			)
		);
		
		if (!isset($processedTerms['type']['class']))
			throw new \Exception("???");
			
		$claimTypeClass = $processedTerms['type']['class'];
		
		$claimTypeObj = new $claimTypeClass($claimType);
		$claimTypeObj->setDefinition($definition);
		
		$this->claimTypes[$claimType] = $claimTypeObj;
		
		$persistenceService->saveClaimType($claimTypeObj);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function getClaimType($claimType)
	{
		return $this->getRepository()->getPersistenceService()->loadClaimTypeByName($claimType);
	}
}
