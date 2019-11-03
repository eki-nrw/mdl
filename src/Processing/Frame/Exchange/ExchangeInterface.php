<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame\Exchange;

use Eki\NRW\Mdl\Processing\Frame\FrameInterface;
use Eki\NRW\Mdl\Processing\ActuateInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;
use Eki\NRW\Mdl\Processing\PipableInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeInterface extends
	FrameInterface,
	ActuateInterface,
	PipableInterface
{
	/**
	* Receive input
	* 
	* @param ElementInterface $frameReceive
	* @param array $contexts
	* 
	* @return void
	* @throws
	*/
	public function receive(ElementInterface $frameReceive, array $contexts = []);

	/**
	* Return the receive thing
	* 
	* @return ElementInterface
	* 
	* @throws \LogicException
	*/
	public function getReceive();

	/**
	* Provide result or results
	* 
	* @param ElementInterface $frameProvide
	* @param array $contexts
	* 
	* @return ElementInteface
	* 
	* @throws
	*/
	public function provide(ElementInterface $frameProvide, array $contexts = []);

	/**
	* Return the provide thing
	* 
	* @return ElementInteface
	*/
	public function getProvide();
}
