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
* Flow interface
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface FlowInterface
{
	/**
	* Returns the name of the flow
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Checks if the flow accepts the given data
	* 
	* @param mixed $data
	* 
	* @return bool
	*/
	public function acceptData($data);
	
	/**
	* Checks if there is a path from $fromEntity to $toEntity
	* 
	* @param object $fromEntity
	* @param objecct $toEntity
	* 
	* @return bool
	*/
	public function canFlow($fromEntity, $toEntity);
	
	/**
	* Flow the given data from the $fromEntity to $toEntity in the situation $options
	* 
	* @param mixed $data
	* @param object $fromEntity
	* @param object $toEntity
	* @param array $options
	* 
	* @throw \InvalidArgumentException
	* 
	* @return void
	*/
	public function flow($data, $fromEntity, $toEntity, array $options = []);
}
