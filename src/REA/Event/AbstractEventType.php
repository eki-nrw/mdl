<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Event;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractEventType implements EventTypeInterface
{
	/**
	* @inheritdoc
	*/
	public function isInput()
	{
		return null;
	}
	
	/**
	* @inheritdoc
	*/
	public function isProvide()
	{
		return null;
	}
	
	/**
	* @inheritdoc
	*/
	//public function getSupportedMethods()
	//{
	//	return array();
	//}
}
