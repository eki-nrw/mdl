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

use Eki\NRW\Common\Common\Variables\HasVariablesInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface BuildingSubjectInterface extends
	HasVariablesInterface
{
	/**
	* Return subject of building
	* 
	* @return object
	*/
	public function getSubject();

	/**
	* Set subject of building
	* 
	* @param object $subject
	* 
	* @return this
	* @throws
	*/
	public function setSubject($subject);

	/**
	* Set subject type
	* 
	* @param string $subjectType
	* 
	* @return this
	* @throws
	*/
	public function setSubjectType($subjectType);
	
	/**
	* Define subject by external data
	* 
	* @param mixed $data
	* @param array $contexts
	* 
	* @return this
	* @throws
	*/
	public function define($data, array $contexts = []);
	
	/**
	* Reset building to empty state
	* 
	* @return this
	* @throws
	*/
	public function reset();

	/**
	* Add element 
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
	* @return this
	* @throws
	*/
	public function add($name, $type = null, $data);
}
