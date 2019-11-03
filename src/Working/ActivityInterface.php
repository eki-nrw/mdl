<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working;

use Eki\NRW\Common\Compose\ObjectItem\HasObjectItemInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Compose\ObjectStates\ObjectStatesInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ActivityInterface extends
	HasActivityTypeInterface,
	HasObjectItemInterface,
	ResponsibilitiesAwareInterface,
	TimingInterface,
	ObjectStatesInterface
{
	/**
	* Returns the name of activity
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Ses the name of activity
	* 
	* @param string $name
	* 
	* @return this
	*/
	public function setName($name);
}
