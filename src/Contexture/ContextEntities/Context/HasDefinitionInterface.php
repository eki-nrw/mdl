<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface HasDefinitionInterface extends DefinitionAwareInterface
{
	/**
	* Returns Definition
	* 
	* @return DefinitionInterface
	*/
	public function getDefinition();
}
