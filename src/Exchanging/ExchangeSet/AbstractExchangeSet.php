<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeSet;

use Eki\NRW\Mdl\Exchanging\Exchange\ExchangesAwareTrait;
use Eki\NRW\Mdl\Exchanging\ExchangeSet\Type\HasExchangeSetTypeTrait;
use Eki\NRW\Common\Participating\ParticipantsAwareTrait;
use Eki\NRW\Common\Participating\PartnersAwareTrait;
use Eki\NRW\Common\Timing\TimingTrait;
use Eki\NRW\Common\Common\DocumentationTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExchangeSet implements ExchangeSetInterface
{
	use
		HasExchangeSetTypeTrait,
		ExchangesAwareTrait,
		PartnersAwareTrait,
		ParticipantsAwareTrait,
		TimingTrait,
		DocumentationTrait
	;

	/**
	* Constructor
	* 
	* @param ExchangeTypeInterface $exchangeType
	* 
	* @throws
	*/
	public function __construct(ExchangeSetTypeInterface $exchangeSetType = null)
	{
		$this->setExchangeSetType($exchangeSetType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchExchangeSetType(ExchangeSetTypeInterface $exchangeSetType)
	{
		//...
	}

	protected function onAddExchange(ExchangeInterface $exchange, $key)
	{
		if (method_exists($exchange, "setExchangeSet"))
			$exchange->setExchangeSet($this);
		
		foreach($this->getPartners() as $partner)
		{
		    $exchange->addPartner($partner);	
		}

		foreach($this->getParticipants() as $participant)
		{
		    $exchange->addParticipant($participant);	
		}
	}

	protected function onRemoveExchange(ExchangeInterface $exchange)
	{
		if (method_exists($exchange, "setExchangeSet"))
			$exchange->setExchangeSet();

		foreach($this->getPartners() as $partner)
		{
			$index = $partner->getIndex();
			if ($xchange->hasPartner($index))
		    	$exchange->removePartnerByIndex($index);	
		}

		foreach($this->getParticipants() as $participant)
		{
			$role = $participant->getRole();
			if ($exchange->hasParticipant($role))
		    	$exchange->removeParticipantByRole($role);	
		}
	}
}
