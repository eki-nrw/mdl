<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Matcher\SubjectBased;

use Eki\NRW\Mdl\MVC\Symfony\Matcher\MatcherInterface as BaseMatcherInterface;

/**
 * Main interface for ....
 */
interface MatcherInterface extends BaseMatcherInterface
{
	/**
	* Checks if a subject matches
	* 
	* @param object $subject
	* 
	* @return bool
	*/
	public function matchSubject($subject);
}
