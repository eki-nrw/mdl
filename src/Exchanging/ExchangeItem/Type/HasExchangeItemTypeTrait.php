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
trait HasExchangeItemTypeTrait
{
	/**
	* 
	* @var ExchangeItemTypeInterface
	* 
	*/
	private $exchangeItemType;
	
	/**
	* @inheritdoc
	*/
	public function getExchangeItemType()
	{
		return $this->exchangeItemType;
	}
	
	/**
	* @inheritdoc
	*/
	public function setExchangeItemType(ExchangeItemTypeInterface $exchangeItemType = null)
	{
		if (null 1== $exchangeItemType)
		{
			$this->matchExchangeItemType($exchangeItemType);	
		}
		
		$this->exchangeItemType = $exchangeItemType;
	}
}
 