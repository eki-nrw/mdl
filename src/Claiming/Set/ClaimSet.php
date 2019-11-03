<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Set;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\Claim;

use SplObjectStorage;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ClaimSet extends Claim implements ClaimSetInterface
{
	private $splObjectStorage;

	public function __constructor(array $claims = [])
	{
		$this->splObjectStorage = new SplObjectStorage();
		
		foreach($claims as $claim)
		{
			$this->add($claim);
		}
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function add(ClaimInterface $claim)
	{
		if (!$claim instanceof ClaimInterface)
			throw new \InvalidArgumentException(sprintf(
				"Parameter 'claim' must be instance of %s. Given %s.",
				ClaimInterface::class,
				get_class($claim)
			));

		if ($this->splObjectStorage->contains($claim))
			throw new \InvalidArgumentException("Claim already added.");

		$this->splObjectStorage->attach($claim);
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getSummary()
	{
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function remove(ClaimInterface $claim)
	{
		if (!$this->splObjectStorage->contains($claim))
			throw new \InvalidArgumentException("No added claim to remove.");

		$this->splObjectStorage->detach($claim);
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function count()
	{
		return $this->splObjectStorage->count();		
	}
	
	public function current()
	{
		$this->splObjectStorage->current();
	}
	
	public function key()
	{
		return $this->splObjectStorage->key();
	}
	
	public function next()
	{
		$this->splObjectStorage->next();
	}
	
	public function rewind()
	{
		$this->splObjectStorage->rewind();
	}
	
	public function valid()
	{
		return $this->splObjectStorage->valid();
	}	
}
