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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeItemsAwareInterface
{
	/**
	* Add an exchange item
	* 
	* @param ExchangeItemInterface $exchangeItem
	* @param string $key
	* 
	* @return void
	* @throws
	*/
	public function addExchangeItem(ExchangeItemInterface $exchangeItem, $key);
	
	/**
	* Remove an existing exchange item
	* 
	* @param ExchangeItemInterface $exchangeItem
	* 
	* @return void
	* @throws
	*/
	public function removeExchangeItem(ExchangeItemInterface $exchangeItem);
	
	/**
	* Remove an existing exchange item by key
	* 
	* @param string $key
	* 
	* @return void
	* @throws
	*/
	public function removeExchangeItemByKey($key);
	
	/**
	* Returns exchange item of key
	* 
	* @param string $key
	* 
	* @return ExchangeItemInterface
	* @throws
	*/
	public function getExchangeItem($key);
	
	/**
	* Gets all exchange items
	* 
	* @return array(ExchangeItemInterface)
	*/
	public function getExchangeItems();
	
	/**
	* Sets all exchange items
	* 
	* @param array(ExchangeItemInterface) $exchangeItems
	* 
	* @return void
	* @throws
	*/
	public function setExchangeItems(array $exchangeItems);
	
	/**
	* Returns the iterated list of exchange items by priority
	* 
	* @return array(ExchangeItemInterface)
	*/
	public function iteratorByPriority();
}
