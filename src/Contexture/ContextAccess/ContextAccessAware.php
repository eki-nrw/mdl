<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess;

use Eki\NRW\Mdl\Contexture\ContextAccess;

/**
 * Interface for ContextAccess aware services.
 */
interface ContextAccessAware
{
	/**
	* Set context access
	* 
	* @param \Eki\NRW\Mdl\Contexture\ContextAccess $contextAccess
	* 
	* @return void
	*/
    public function setContextAccess(ContextAccess $contextAccess = null);
}
