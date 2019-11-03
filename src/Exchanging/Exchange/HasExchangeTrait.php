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
trait HasExchangeTrait
{
	/**
	* 
	* @var ExchangeInterface
	* 
	*/
	private $exchange;
	
	/**
	* @inheritdoc
	*/
	public function getExchange()
	{
		return $this->exchange;
	}
	
	/**
	* @inheritdoc
	*/
	public function setExchange(ExchangeInterface $exchange = null)
	{
		$this->exchange = $exchange;
	}
}
