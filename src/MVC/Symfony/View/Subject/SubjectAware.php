<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Subject;

interface SubjectAware
{
	/**
	* Returns subject
	* 
	* @return mixed
	*/
	public function getSubject();
	
	/**
	* Sets subject
	* 
	* @param mixed $subject
	* 
	* @return void
	*/
	public function setSubject($subject);
}
