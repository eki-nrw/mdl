<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface HasFrameInterface
{
	/**
	* Returns frame
	* 
	* @return FrameInterface
	*/
	public function getFrame();
	
	/**
	* Set frame
	* 
	* @param FrameInterface $frame
	* 
	* @return
	*/
	public function setFrame(FrameInterface $frame = null);
}
