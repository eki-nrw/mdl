<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeItem\Type;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface HasExchangeItemTypeInterface
{
	/**
	* Returns exchange item type
	* 
	* @return ExchangeItemTypeInterface
	*/
	public function getExchangeItemType();
	
	/**
	* Sets exchange item type
	* 
	* @param ExchangeItemTypeInterface|null $exchangeItemType
	* 
	* @return void
	*/
	public function setExchangeItemType(ExchangeItemTypeInterface $exchangeItemType = null);

	/**
	* Validate matched exchange item type
	* 
	* @param ExcahngeItemTypeInterface $exchangeItemType
	* 
	* @return void
	* @throws \InvalidArgumentException
	*/
	protected function matchExchangeItemType(ExchangeItemTypeInterface $exchangeItemType);
}
