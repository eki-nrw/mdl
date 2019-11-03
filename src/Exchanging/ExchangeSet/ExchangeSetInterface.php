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

use Eki\NRW\Mdl\Exchanging\ExchangeSet\Type\HasExchangeSetTypeInterface;
use Eki\NRW\Mdl\Exchanging\Exchange\ExchangesAwareInterface;
use Eki\NRW\Common\Participating\ParticipantsAwareInterface;
use Eki\NRW\Common\Participating\PartnersAwareInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Common\DocumentationInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeSetInterface extends
	HasExchangeSetTypeInterface,
	ExchangesAwareInterface,
	PartnersAwareInterface,
	ParticipantsAwareInterface,
	TimingInterface,
	DocumentationInterface
{
}
