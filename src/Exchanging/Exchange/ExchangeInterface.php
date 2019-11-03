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

use Eki\NRW\Mdl\Exchanging\Exchange\Type\HasExchangeTypeInterface;
use Eki\NRW\Mdl\Exchanging\ExchangeItem\ExchangeItemsAwareInterface;
use Eki\NRW\Common\Participating\ParticipantsAwareInterface;
use Eki\NRW\Common\Participating\PartnersAwareInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Common\HasPropertiesInterface;
use Eki\NRW\Common\Common\DocumentationInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeInterface extends 
	HasExchangeTypeInterface,
	ExchangeItemsAwareInterface,
	PartnersAwareInterface,
	ParticipantsAwareInterface,
	TimingInterface,
	HasPropertiesInterface,
	DocumentationInterface
{
	const EXCHANGE_PRIORITY_DEFAULT = 0;
}
