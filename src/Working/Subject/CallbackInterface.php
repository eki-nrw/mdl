<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface CallbackInterface
{
	/**
	* Get type name of callback
	* 
	* @return string
	*/
	public function getCallbackType();

	/**
	* Assigns subject
	* 
	* @param object $subject
	* 
	* @return void
	* @throw \InvalideArgumentException If $subject is not matched with callback
	*/
	public function assignSubject($subject);
	
	/**
	* Get a property
	* 
	* @param string $name
	* 
	* @return mixed
	* @throw \InvalideArgumentException If $name do not supports. Call 'has' first to check
	*/
	public function get($name);
	
	/**
	* Sets a property
	* 
	* @param string $name
	* @param mixed $data
	* 
	* @return void
	* @throw \InvalideArgumentException If $name of $data cannot set. Call 'canSet' first to check
	*/
	public function set($name, $data);
	
	/**
	* Checks if property exists
	* 
	* @param string $name
	* 
	* @return bool
	*/
	public function has($name);

	/**
	* Checks if write to property
	* 
	* @param string $name
	* 
	* @return bool
	*/
	public function canSet($name);
	
	/**
	* Add an element
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
	* @return void
	* @throw \InvalideArgumentException If $name of $data of type $type do not supports. Call 'addSupport' first to check
	*/
	public function add($name, $type, $data);
	
	/**
	* Checks if support add method
	* 
	* @param string $name
	* @param mixed $type
	* @param mixed $data
	* 
	* @return bool
	*/
	public function addSupport($name, $type, $data);
	
}
