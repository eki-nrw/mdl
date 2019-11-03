<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface SubjectContinuationInterface
{
	/**
	* Create a relationship between the subject and the other subject. 
	* Both subjects has the same working type 
	* and the other subject is created by the given continuation
	* 
	* @param object $subject
	* @param object $otherSubject
	* @param string $workingType
	* @param string $continuation
	* 
	* @return \Eki\NRW\Component\Working\Relations\Relationship\RelationshipInterface
	*/
	public function continuingSubjects($subject, $otherSubject, $workingType, $continuation);
	
	/**
	* Get continued subject of the given subject
	* 
	* @param object $subject
	* @param string $workingType
	* @param string $continuation
	* @param bool $back If true, return subject is the continued subject. Otherwise, return subject is the original subject.
	* 
	* @return object|null
	* @throws
	* 
	*/
	public function getContinuedSubject($subject, $workingType, $continuation, $back = false);
	
	/**
	* Get the continue subject type
	* 
	* @param string $subjectType
	* @param string $workingType
	* @param string $continuation
	* @param array $contexts
	* 
	* @return string
	*/
	public function getContinuedSubjectType($subjectType, $workingType, $continuation, array $contexts = []);
}
