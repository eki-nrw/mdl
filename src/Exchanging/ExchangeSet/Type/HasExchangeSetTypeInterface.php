<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeSet\Type;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface HasExchangeSetTypeInterface
{
	/**
	* Returns exchange set type
	* 
	* @return ExchangeSetTypeInterface
	*/
	public function getExchangeSetType();
	
	/**
	* Sets exchange set type
	* 
	* @param ExchangeSetTypeInterface|null $exchangeSetType
	* 
	* @return void
	*/
	public function setExchangeSetType(ExchangeSetTypeInterface $exchangeSetType = null);
	
	/**
	* Validate matched exchange set type
	* 
	* @param ExchangeTypeInterface $exchangeType
	* 
	* @return void
	* @throws \InvalidArgumentException
	*/
	protected function matchExchangeSetType(ExchangeSetTypeInterface $exchangeSetType);
}
 