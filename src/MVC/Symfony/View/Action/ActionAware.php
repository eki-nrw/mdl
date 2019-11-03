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

interface ActionAware
{
	const ACTION_TYPE_CLASS = "class";
	const ACTION_TYPE_SERVICE = "service";
	const ACTION_TYPE_ARGUMENT = "argument";
	const ACTION_TYPE_WORKFLOW = "workflow";

	/**
	* Returns action
	* 
	* @return mixed
	*/	
	public function getAction();

	/**
	* Sets action
	* 
	* @param mixed $action
	* 
	* @return void
	*/
	public function setAction($action);
}
