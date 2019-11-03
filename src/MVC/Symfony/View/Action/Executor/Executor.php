<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Action\Executor;

use Eki\NRW\Mdl\MVC\Symfony\View\Executor as BaseExecutor;
use Eki\NRW\Mdl\MVC\Symfony\View\View;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface Executor extends BaseExecutor
{
	/**
	* Checks if the executor supports or not
	* 
	* @param View $view
	* 
	* @return bool
	*/
	public function support(View $view);
}
