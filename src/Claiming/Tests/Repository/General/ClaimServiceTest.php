<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Tests\Repository\General;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\ClaimTypeInterface;
use Eki\NRW\Mdl\Claiming\Claim;

use Eki\NRW\Mdl\Claiming\Repository\ClaimServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\ClaimTypeServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\ClaimService;
use Eki\NRW\Mdl\Claiming\Repository\General\RepositoryInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\DispatcherInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\FindServiceInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\PersistenceServiceInterface;

use PHPUnit\Framework\TestCase;

class ClaimServiceTest extends TestCase
{
	public function testConstructor_atleast()
	{
		$claimService = new ClaimService(
			$this->getMockBuilder(RepositoryInterface::class)->getMock()
		);	
	}

	public function testConstructor_w_dispatcher()
	{
		$claimService = new ClaimService(
			$this->getMockBuilder(RepositoryInterface::class)->getMock(),
			$this->getMockBuilder(DispatcherInterface::class)->disableAutoload()->getMock()
		);	
	}

	public function testCreateClaim()
	{
		$claimService = $this->createClaimService();
		
		$claim = $claimService->createClaim("a_claim_type");
		
		$this->assertNotNull($claim);
	}
	
	private function createClaimService()
	{
		$testCase = $this;
		
		// Repository
		$repository = $this->getMockBuilder(RepositoryInterface::class)
			->setMethods(['getClaimService', 'getClaimTypeService', 'getPersistenceService', 'getFindService'])
			->getMock()
		;

		$repository
			->expects($this->any())
			->method('getClaimService')
			->will($this->returnCallback(function() use ($testCase) {
				$claimService = $testCase
					->getMockBuilder(ClaimServiceInterface::class)
					->getMock()
				;
				
				return $claimService;
			}))
		;
		
		$repository
			->expects($this->any())
			->method('getClaimTypeService')
			->will($this->returnCallback(function() use ($testCase) {
				$claimTypeService = $testCase
					->getMockBuilder(ClaimTypeServiceInterface::class)
					->setMethods(['getClaimType'])
					->getMockForAbstractClass()
				;
				
				$claimTypeService
					->expects($testCase->any())
					->method('getClaimType')
					->will($testCase->returnCallback(function($claimType) use ($testCase) {
						$claimType = $testCase->getMockBuilder(ClaimTypeInterface::class)
							->getMock()
						;
						
						return $claimType;
					}))
				;
				
				return $claimTypeService;
			}))
		;

		$repository
			->expects($this->any())
			->method('getPersistenceService')
			->will($this->returnCallback(function() use ($testCase) {
				$persistenceService = $testCase
					->getMockBuilder(PersistenceServiceInterface::class)
					->setMethods(['saveClaim'])
					->getMockForAbstractClass()
				;
				
				$persistenceService
					->expects($testCase->any())
					->method('saveClaim')
					->will($testCase->returnCallback(function($claim) {
					}))
				;
				
				return $persistenceService;
			}))
		;

		$repository
			->expects($this->any())
			->method('getFindService')
			->will($this->returnCallback(function() use ($testCase) {
				$findService = $testCase
					->getMockBuilder(FindServiceInterface::class)
					->getMockForAbstractClass()
				;
				
				return $findService;
			}))
		;
		
		// Dispatcher
		$dispatcher = $this->getMockBuilder(DispatcherInterface::class)
			->disableAutoload()
			->setMethods(['dispatch'])
			->getMock()
		;
		
		$dispatcher
			->expects($this->any())
			->method('dispatch')
			->will($this->returnCallback(function(
				$eventName,
				$operation,
				ClaimInterface $claim = null,
				ParticipantInterface $participant = null,
				array $options = []		
			) 
			{
				echo "Dispatch event " . $eventName . 
					" for operation " . $operation . 
					" on claim " . $claim->getCode() . 
					" by " . $participant->getName()
				;
			}))
		;
		
		// Claim Service
//		$claimService = new ClaimService($repository, $dispatcher);

		$claimService = $this->getMockBuilder(ClaimService::class)
			->disableAutoload()
			->setMethods(['getClaimClass'])
			->setConstructorArgs(array($repository, $dispatcher))
			->getMock()
		;
		
		$claimService
			->expects($this->any())
			->method('getClaimClass')
			->will($this->returnCallback(function(ClaimTypeInterface $claimType) {
				return Claim::class;	
			}))
		;
		
		return $claimService;
	}
}
