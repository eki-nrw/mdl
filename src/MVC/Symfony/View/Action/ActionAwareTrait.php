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

trait ActionAwareTrait
{
	private $action;

	/**
	* @inheritdoc
	* 
	*/	
	public function getAction()
	{
		return $this->action;
	}

	/**
	* @inheritdoc
	* 
	*/	
	public function setAction($action)
	{
		$this->action = $action;
	}
}
