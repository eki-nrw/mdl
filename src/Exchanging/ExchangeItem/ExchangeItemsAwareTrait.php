<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeItem;

use ArrayIterator;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait ExchangeItemsAwareTrait
{
	/**
	* @var array
	*/
	private $exchangeItems = array();
	
	/**
	* @inheritdoc
	*/
	public function addExchangeItem(ExchangeItemInterface $exchangeItem, $key)
	{
		$this->validateExchangeItem($exchangeItem);

		if (isset($this->exchangeItems[$key]))
			throw new \InvalidArgumentException(sprintf("Key $key already exists."));
		
		if ($this instanceof ExchangeInterface)
			$exchangeItem->setExchange($this);
			
		$this->exchangeItems[$key] = $exchangeItem;
	}
	
	/**
	* Validate exchange item
	* 
	* @param ExchangeItemInterface $exchangeItem
	* 
	* @return void
	* @throws
	*/
	//abstract protected function validateExchangeItem(ExchangeItemInterface $exchangeItem);

	/**
	* @inheritdoc
	*/
	public function removeExchangeItem(ExchangeItemInterface $exchangeItem)
	{
		foreach($this->exchangeItems as $key => $traceItem)
		{
			if ($traceItem === $exchangeItem)
			{
				if ($this instanceof ExchangeInterface)
					$exchangeItem->setExchange();
				unset($this->exchangeItems[$key]);
				return;
			}
		}

		throw new \InvalidArgumentException('Exchange item is not in list to move.');
	}

	/**
	* @inheritdoc
	*/
	public function removeExchangeItemByKey($key)
	{
		if (!isset($this->exchangeItems[$key]))
			throw new \InvalidArgumentException("No key $key to remove");
			
		if ($this instanceof ExchangeInterface)
			$exchangeItem->setExchange();
		unset($this->exchangeItems[$key]);
	}

	/**
	* @inheritdoc
	*/
	public function getExchangeItem($key)
	{
		if (isset($this->exchangeItems[$key]))
			return $this->exchangeItems[$key];
	}
	
	/**
	* @inheritdoc
	*/
	public function getExchangeItems()
	{
		return $this->exchangeItems;
	}

	/**
	* @inheritdoc
	*/
	public function setExchangeItems(array $exchangeItems)
	{
		$this->exchangeItems = [];
		foreach($exchangeItems as $itemKey => $exchangeItem)
		{
			if (!is_string($itemKey))
				$itemKey = null;
			$this->addExchangeItem($exchangeItem, $itemKey);
		}
	}

	/**
	* @inheritdoc
	*/
	public function iteratorByPriority()
	{
		$sort = array();
		foreach($this->getExchangeItems() as $itemKey => $item)
		{
			$sort[$itemKey] = $item->getPriority();
		}
		
		$_iterator = new ArrayIterator($sort);
		$_iterator->asort();
		
		$iterator = array();
		foreach($_iterator as $key => $val)
		{
			$iterator[$key] = $this->exchangeItems[$key];
		}
		
		return $iterator;
	}
}
