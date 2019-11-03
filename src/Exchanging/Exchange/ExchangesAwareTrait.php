<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\Exchange;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
trait ExchangesAwareTrait
{
	/**
	* @var array
	*/
	private $exchanges = array();
	
	/**
	* @inheritdoc
	*/
	public function addExchange(ExchangeInterface $exchange, $key)
	{
		if (isset($this->exchanges[$key]))
			throw new \InvalidArgumentException(sprintf("Key $key already exists."));

		$this->exchanges[$key] = $exchange;

		$this->onAddExchange($exchange, $key);
	}

	//protected function onAddExchange(ExchangeInterface $exchange, $key);
	
	/**
	* @inheritdoc
	*/
	public function removeExchange(ExchangeInterface $exchange)
	{
		foreach($this->exchanges as $key => $traceExchange)
		{
			if ($exchange === $traceExchange)
			{
				$this->onRemoveExchange($exchange);
				unset($this->exchanges[$key]);
				return;
			}
		}

		throw new \InvalidArgumentException('Exchange is not in list to move.');
	}

	//protected function onRemoveExchange(ExchangeInterface $exchange);

	/**
	* @inheritdoc
	*/
	public function removeExchangeByKey($key)
	{
		if (!isset($this->exchanges[$key]))
			throw new \InvalidArgumentException("No key $key to remove");
			
		if ($this instanceof ExchangeSetInterface and method_exists($exchange, "setExchangeSet"))
			$exchange->setExchangeSet();
		unset($this->exchanges[$key]);
	}

	/**
	* @inheritdoc
	*/
	public function getExchange($key)
	{
		if (isset($this->exchanges[$key]))
			return $this->exchanges[$key];
	}

	/**
	* @inheritdoc
	*/
	public function hasExchange($key)
	{
		return isset($this->exchanges[$key]);
	}
	
	/**
	* @inheritdoc
	*/
	public function getExchanges()
	{
		return $this->exchanges;
	}

	/**
	* @inheritdoc
	*/
	public function setExchanges(array $exchanges)
	{
		$this->exchanges = [];
		foreach($exchanges as $key => $exchange)
		{
			if (!is_string($key))
				$key = null;
			$this->addExchange($exchange, $key);
		}
	}
}
