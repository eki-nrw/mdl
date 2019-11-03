<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Action;

use Eki\NRW\Mdl\MVC\Symfony\View\View;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface Executor
{
	/**
	* Execute an action view
	* 
	* @param View $view
	* 
	* @return void
	* 
	* @throws
	*/
	public function execute(View $view);
}
