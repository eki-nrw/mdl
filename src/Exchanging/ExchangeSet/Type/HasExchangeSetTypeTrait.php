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
trait HasExchangeSetTypeTrait
{
	/**
	* 
	* @var ExchangeSetTypeInterface
	* 
	*/
	private $exchangeSetType;
	
	/**
	* @inheritdoc
	*/
	public function getExchangeSetType()
	{
		return $this->exchangeSetType;
	}
	
	/**
	* @inheritdoc
	*/
	public function setExchangeSetType(ExchangeSetTypeInterface $exchangeSetType = null)
	{
		if (null !== $exchangeSetType)
		{
			$this->matchExchangeSetType($exchangeSetType);
		}
		
		$this->exchangeSetType = $exchangeSetType;
	}
}
