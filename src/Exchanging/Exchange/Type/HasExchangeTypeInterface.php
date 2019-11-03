<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\Exchange\Type;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface HasExchangeTypeInterface
{
	/**
	* Returns exchange type
	* 
	* @return ExchangeTypeInterface
	*/
	public function getExchangeType();
	
	/**
	* Sets exchange type
	* 
	* @param ExchangeTypeInterface|null $exchangeType
	* 
	* @return void
	*/
	public function setExchangeType(ExchangeTypeInterface $exchangeType = null);
	
	/**
	* Validate matched exchange type
	* 
	* @param ExchangeTypeInterface $exchangeType
	* 
	* @return void
	* @throws \InvalidArgumentException
	*/
	protected function matchExchangeType(ExchangeTypeInterface $exchangeType);
}
 