<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Flow;

/**
* Data flow interface
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface DataFlowInterface
{
	/**
	* Returns the name of data flow
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Set data
	* 
	* @param mixed|null $data
	* 
	* @return this
	*/
	public function setData($data = null);
	
	/**
	* Checks if there is a path from $fromEntity to $toEntity
	* 
	* @param object $fromEntity
	* @param objecct $toEntity
	* 
	* @return bool
	*/
	public function can($fromEntity, $toEntity);
	
	/**
	* Flow the given data from the $fromEntity to $toEntity in the situation $options
	* 
	* @param mixed $data
	* @param object $fromEntity
	* @param object $toEntity
	* @param array $options
	* 
	* @throw 
	* 
	* @return this
	*/
	public function flow($fromEntity, $toEntity, array $options = []);
}
