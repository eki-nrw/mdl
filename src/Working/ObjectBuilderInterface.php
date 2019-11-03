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

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ObjectBuilderInterface
{
	/**
	* Sets object
	* 
	* @param object $object
	* 
	* @return this
	*/
	public function setObject($object);

	/**
	* Sets object type
	* 
	* @param string $objectType
	* 
	* @return this
	*/
	public function setObjectType($objectType);
	
	/**
	* Import external data
	* 
	* @param mixed $data
	* @param array $contexts
	* 
	* @return this
	*/
	public function import($data, array $contexts = []);
	
	/**
	* Checks what data can import
	* 
	* @param mixed $data
	* 
	* @return bool
	*/
	public function importSupport($data);

	/**
	* Set an info.
	* 
	* @param string $name
	* @param mixed $data
	* 
	* @return this
	*/
	public function set($name, $data = null);

	/**
	* Add an element
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
 	* @return this
	*/
	public function add($name, $type = null, $data = null);
	
	/**
	* Map an element from external data
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
	* @return this
	*/
	public function map($name, $type = null, $data = null);
	
	/**
	* Create and build object 
	* 
	* @return object
	*/
	public function build();
	
	/**
	* Reset builder to empty state
	* 
	* @return this
	*/
	public function reset();

}
