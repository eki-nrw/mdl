<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Builder\Subject;

/**
 * Subject Loader interface.
 */
interface Loader
{
	/**
	* Load subject object
	* 
	* @param mixed $subjectId
	* 
	* @return object
	*/
    public function loadSubject($subjectId);

	/**
	* Load embeded subject
	* 
	* @param mixed $subjectId
	* 
	* @return object
	*/
    public function loadEmbeddedSubject($subjectId);
}
