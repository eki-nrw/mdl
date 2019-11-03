<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Exchange\Event\Transfer;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait TransfersAwareTrait
{
	/**
	* @var array
	*/
	protected $transfers = [];

	/**
	* @inheritdoc
	*/	
	public function getTransfers()
	{
		return $this->transfers;
	}
	
	/**
	* @inheritdoc
	*/	
	public function setTransfers(array $transfers = [])
	{
		foreach($transfers as $key => $transfer)
		{
			if (!$transfer instanceof TransferInterface)
				throw new \InvalidArgumentException(sprintf(
					"One of transfers with key %s is not instance of %s. Given %s.",
					$key,
					TransferInterface::class,
					get_class($transfer)
				));		
		}

		$this->transfers = [];
		foreach($transfers as $key => $transfer)
		{
			$this->addTransfer($transfer, $key);
		}
	}
	
	/**
	* @inheritdoc
	*/	
	public function addTransfer(TransferInterface $transfer, $key)
	{
		if (in_array($transfer, array_values($this->transfers), true))
			throw new \InvalidArgumentException('Cannot add twice the same transfer.');	
			
		if (isset($this->transfers[$key]))
			throw new \InvalidArgumentException("Transfer key $key already exits.");
			
		$this->transfers[$key] = $transfer;
	}
	
	/**
	* @inheritdoc
	*/	
	public function removeTransfer(TransferInterface $transfer)
	{
		if (!in_array($transfer, array_values($this->transfers), true))
			throw new \LogicException('No transfer to remove.');
		
		foreach($this->transfers as $key => $traceTransfer)
		{
			if ($traceTransfer === $transfer)
			{
				unset($this->transfers[$key]);
				return;
			}
		}
	}

	/**
	* @inheritdoc
	*/	
	public function removeTransferByKey($key)
	{
		if (!isset($this->transfers[$key]))
			throw new \InvalidArgumentException("No transfer key $key to remove.");
			
		unset($this->transfers[$key]);
	}

	/**
	* @inheritdoc
	*/	
	public function hasTransfer($key)
	{
		return isset($this->transfers[$key]);
	}

	/**
	* @inheritdoc
	*/	
	public function getTransfer($key)
	{
		if (!isset($this->transfers[$key]))
			throw new \InvalidArgumentException("No transfer key $key to get.");
			
		return $this->transfers[$key];
	}
}
