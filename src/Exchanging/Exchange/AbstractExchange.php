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

use Eki\NRW\Mdl\Exchanging\Type\HasExchangeTypeTrait;
use Eki\NRW\Mdl\Exchanging\ExchangeItem\ExchangeItemsAwareTrait;
use Eki\NRW\Common\Participating\ParticipantsAwareTrait;
use Eki\NRW\Common\Participating\PartnersAwareTrait;
use Eki\NRW\Common\Timing\TimingTrait;
use Eki\NRW\Common\Common\HasPropertiesTrait;
use Eki\NRW\Common\Common\DocumentationTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExchange implements ExchangeInterface
{
	use
		ExchangeItemsAwareTrait,
		PartnersAwareTrait,
		ParticipantsAwareTrait,
		HasExchangeTypeTrait,
		TimingTrait,
		HasPropertiesTrait,
		DocumentationTrait
	;

	/**
	* Constructor
	* 
	* @param ExchangeTypeInterface $exchangeType
	* 
	* @throws
	*/
	public function __construct(ExchangeTypeInterface $exchangeType = null)
	{
		$this->setExchangeType($exchangeType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchExchangeType(ExchangeTypeInterface $exchangeType)
	{
		//...
	}
	
	/**
	* @inheritdoc
	*/
	protected function validateExchangeItem(ExchangeItemInterface $exchangeItem)
	{
		if (null === $exchangeItem->getExchangeItemType())
			throw new \UnexpectedValueException("Exchange item to add must have exchange item type.");		
	}

}
