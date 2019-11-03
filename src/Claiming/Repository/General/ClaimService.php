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
use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\Set\ClaimSetInterface;
use Eki\NRW\Mdl\Claiming\Repository\General\RepositoryInterface;
use Eki\NRW\Common\Particpating\ParticipantInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ClaimService implements ClaimServiceInterface
{
	/**
	* @var \Eki\NRW\Mdl\Claiming\Repository\General\RepositoryInterface
	*/
	private $repository;
	
	/**
	* @var DispatcherInteface
	*/
	private $dispatcher;
	
	protected function getRepository()
	{
		return $this->repository;
	}
	
	public function __construct(RepositoryInterface $repository, DispatcherInterface $dispatcher = null)
	{
		$this->repository = $repository;
		$this->dispatcher = $dispatcher;
	}
	
	/**
	* Create an empty claim of claim type
	* 
	* @param string $claimType
	* 
	* @return ClaimInterface
	* 
	* @throw
	*/
	public function createClaim($claimType, array $terms = [])
	{
		if (null === ($claimTypeObj = $this->getClaimType($claimType)))
		{
			throw new \InvalidArgumentException("No claim type $claimType.");
		}
		
		$claim = $this->getClaimClass($claimTypeObj);
		$claim->setClaimType($claimTypeObj);

		return $claim;
	}
	
	protected function getClaimClass(ClaimTypeInterface $claimType)
	{
		$definition = $claimType->getDefinition();
		$processedTerms = $definition->processMeaning(
			array(
				'claim' => array(
					'class' => null
				)
			)
		);

		return $processedTerms['claim']['class'];
	}

	protected function getClaimType($claimType)
	{
		return $this->getRepository()->getClaimTypeService()->getClaimType($claimType);
	}
	
	/**
	* Register a claim to system
	* 
	* @param ClaimInterface $claim
	* 
	* @return void
	* 
	* @throws
	*/	
	public function registerClaim(ClaimInterface $claim)
	{
		$this->getRepository()->getPersistenceService()->saveClaim($claim);
	}

	/**
	* Do action to a claim on behalf of participant role
	* 
	* @param string $action
	* @param ClaimInterface $claim
	* @param ParticipantInterface|null $participant
	* @param array $options
	* 
	* @return void
	* @throws
	*/
	public function operate($action, ClaimInterface $claim, ParticipantInterface $participant, array $options = [])
	{
		if (!$this->canDo($action, $claim, $participant, $options))
		{
			throw new \Exception("????!!!");	
		}
		
		if ($claim->getParticipant($participant->getRole()) === null)
		{
			$claim->addParticipant($participant);
		}
				
		if ($claim instanceof ClaimSetInterface)
		{
			if ($action === 'add' || $action === 'remove')
			{
				$item = $options['claim'];
				if (!$item instanceof ClaimInterface)
					throw new \InvalidArgumentException(sprintf(
						"Index 'claim' of parameter 'options' must be instance of %s. Given %s.",
						ClaimInterface::class,
						get_class($options['claim'])
					));

				if ($action === 'add')
				{
					if ($item->getSubjectable()->getSubject() === null)
					{
						if (null !== ($subject = ($claim->getSubjectable()->getSubject())))
							$item->getSubjectable()->setSubject($subject);
						else
						{
							// throw new \Exception("???");
						}
					}
										
					$claim->add($item);
				}
				else if ($action === 'remove')
				{
					$claim->remove($item);
				}
			}	
		}
		
		$this->dispatch(
			DispatcherInterface::DISPATCH_CLAIM_DO,
			$action,
			$claim,
			$participant,
			$options
		);
	}
	
	private function dispatch($eventName, $action, ClaimInterface $claim, ParticipantInterface $participant, array $options)
	{
		if ($this->dispatcher !== null)
		{
			$this->dispatcher->dispatch(
				$eventName,
				$action,
				$claim,
				$participant,
				$options
			);
		}
	}
	
	protected function canAccess($action, ClaimInterface $claim, ParticipantInterface $participant, array $options = [])
	{
		try 
		{
			$role = $participant->getRole();
			$definition = $claim->getClaimType()->getDefinition();
			
			if ($claim->getParticipant($role) === null)
			{
				$processedTerms = $definition->processMeaning(
					array(
						'participants' => array(
							$role => array(
								'name' => $participant->getName(),
								'class' => get_class($participant)
							)
						)
					)
				);
			}

			$processedTerms = $definition->processMeaning(
				array(
					'operations' => array(
						'actions' => array(
							$action => array(
								'participants' => array($role)
							)
						)
					)
				)
			);
			
			return true;
		}
		catch(\Exception $e)
		{
			// logger->log
			
			return false;
		}
	}

	protected function canDo($action, ClaimInterface $claim, ParticipantInterface $participant, array $options = [])
	{
		if ($this->canAccess($action, $claim, $participant, $options) !== true)
			return false;
			
	}

	/**
	* @inheritdoc
	* 
	*/
	public function findClaims(array $criteria, ParticipantInterface $participant)
	{
		return $this->getRepository()->getFindService()->findClaims($criteria, $participant);	
	}
}
