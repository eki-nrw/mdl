<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Modeling;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface HasDefinitionInterface
{
	public function getDefinition();
	public function setDefinition(DefinitionInterface $definition = null);
}
