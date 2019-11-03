<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ViewManagerInterface
{
    const VIEW_TYPE_FULL = 'full';
    const VIEW_TYPE_LINE = 'line';

	/**
	* Render a view
	* 
	* @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
	* @param array $defaultParameters
	* 
    * @throws \RuntimeException
	* 
	* @return string
	*/
    public function renderView(View $view, array $defaultParameters = array());

	/**
	* Render an subjected object
	* 
	* @param object $subject
	* @param string $viewType
	* @param array $parameters
	* @param callable $func
	* 
	* @return string
	*/
    public function renderSubject(
    	$subject, 
    	$viewType = ViewManagerInterface::VIEW_TYPE_FULL, 
    	$parameters = array()
    );
}
