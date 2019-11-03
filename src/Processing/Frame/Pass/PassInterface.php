<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame\Pass;

use Eki\NRW\Mdl\Processing\ActuateInterface;
use Eki\NRW\Mdl\Processing\PipableInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Mdl\Processing\Frame\FrameInterface;
use Eki\NRW\Mdl\Processing\ElementInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface PassInterface extends
	FrameInterface,
	ActuateInterface,
	TimingInterface,
	PipableInterface
{
	/**
	* Arrive
	* 
	* @param mixed $contexts
	* 
	* @return void
	* 
	* @throws
	*/
	public function arrive(array $contexts = []);
	
	/**
	* Leave
	* 
	* @param ElementInterface $leave
	* @param array $contexts
	* 
	* @return void
	* 
	* @throws
	*/
	public function leave(ElementInterface $leave, array $contexts = []);
	
	/**
	* Get Leave data
	* 
	* @return ElementInterface
	*/
	public function getLeave();
}
