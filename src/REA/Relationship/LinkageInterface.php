<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Relationship;

use Eki\NRW\Mdl\REA\Resource\ResourceInterface;

/**
* Linkage is relationship between resource and (another) resource
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface LinkageInterface extends RelationshipInterface
{
	/**
	* Returns the resource
	* 
	* @return ResourceInterface
	*/
	public function getResource();
	
	/**
	* Returns the other resource
	* 
	* @return ResourceInterface
	*/
	public function getOtherResource();
}
