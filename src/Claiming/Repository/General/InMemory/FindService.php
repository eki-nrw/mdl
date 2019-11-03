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

use Eki\NRW\Mdl\Claiming\Repository\General\RepositoryInrterface;
use Eki\NRW\Mdl\Claiming\Repository\General\FindServiceInterface;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\ClaimSetInterface;
use Eki\NRW\Common\Particpating\ParticipantInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class FindService implements FindServiceInterface
{
	/**
	* @var RepositoryInrterface
	*/
	private $repository;

	public function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function findClaims(array $criteria, ParticipantInterface $participant)
	{
		$this->repository->getPersistenceService()->findClaims($criteria);	
	}
}
