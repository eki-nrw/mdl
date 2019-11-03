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
interface FrameInterface
{
	/**
	* Returns frame type
	* 
	* @return string
	*/
	public static function getFrameType();
	
	/**
	* Returns type 
	* 
	* @return string
	*/
	public function getType();
	
	/**
	* Sets type
	* 
	* @param string $type
	* 
	* @return void
	*/
	public function setType($type);
	
	/**
	* Get frame input or inputs
	* 
	* @return ElemenInterface|ElemenInterface[]
	*/
	public function getFrameInput();

	/**
	* Get frame output or ioutputs
	* 
	* @return ElemenInterface|ElemenInterface[]
	*/
	public function getFrameOutput();
}
