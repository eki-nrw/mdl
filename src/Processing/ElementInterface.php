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

use Eki\NRW\Mdl\Processing\HasFrameInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ElementInterface extends
	HasFrameInterface,
	SubjectableInterface
{
	/**
	* Returns the key of the element
	* 
	* @return string
	*/
	public function getKey();
	
	/**
	* Sets key 
	* 
	* @param string $key
	* 
	* @return void
	*/
	public function setKey($key);
	
	/**
	* Returns the branch
	* 
	* @return mixed
	*/
	public function getBranch();
	
	/**
	* Set branch
	* 
	* @param mixed $branch
	* @param array $contexts
	* 
	* @return void
	*/
	public function setBranch($branch, array $contexts = []);
}
