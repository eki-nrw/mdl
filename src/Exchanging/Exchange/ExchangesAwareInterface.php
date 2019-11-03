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
interface ExchangesAwareInterface
{
	/**
	* Add an exchange item
	* 
	* @param ExchangeInterface $exchange
	* @param string $key
	* 
	* @return void
	* @throws
	*/
	public function addExchange(ExchangeInterface $exchange, $key);
	
	/**
	* Remove an existing exchange item
	* 
	* @param ExchangeInterface $exchange
	* 
	* @return void
	* @throws
	*/
	public function removeExchange(ExchangeInterface $exchange);
	
	/**
	* Remove an existing exchange item by key
	* 
	* @param string $key
	* 
	* @return void
	* @throws
	*/
	public function removeExchangeByKey($key);
	
	/**
	* Returns exchange item of key
	* 
	* @param string $key
	* 
	* @return ExchangeInterface
	* @throws
	*/
	public function getExchange($key);
	
	/**
	* Checks if there is an exchange $key
	* 
	* @param string $key
	* 
	* @return bool
	*/
	public function hasExchange($key);
	
	/**
	* Gets all exchange items
	* 
	* @return array(ExchangeInterface)
	*/
	public function getExchanges();
	
	/**
	* Sets all exchange items
	* 
	* @param array(ExchangeInterface) $exchanges
	* 
	* @return void
	* @throws
	*/
	public function setExchanges(array $exchanges);
}
