<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Storage;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface StorageAwareInterface
{
	/**
	* Sets storage 
	* 
	* @param StorageInterface|null $storage
	* 
	* @return void
	*/
	public function setStorage(StorageInterface $storage = null);
}
