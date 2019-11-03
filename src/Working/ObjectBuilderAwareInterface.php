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
interface ObjectBuilderAwareInterface
{
	/**
	* Sets object builder
	* 
	* @param ObjectBuilderInterface|null $objectBuilder
	* 
	* @return void
	*/
	public function setObjectBuilder(ObjectBuilderInterface $objectBuilder = null);
}
