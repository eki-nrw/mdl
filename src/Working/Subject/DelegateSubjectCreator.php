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
class DelegateSubjectCreator implements SubjectCreatorInterface
{
	/**
	* @var SubjectCreatorInterface[]
	*/
	private $creators = [];
	
	public function __construct(array $creators = [])
	{
		foreach($creators as $creator)
		{
			if (!$creator instanceof SubjectCreatorInterface)
				throw new \InvalidArgumentException(sprintf(
					"Subject creator must be instance of %s. Given %s.",
					SubjectCreatorInterface::class, get_class($creator)
				));
				
		}

		$this->creators = $creators;
	}

	/**
	* @inheritdoc
	*/
	public function support($subjectType)
	{
		foreach($this->creators as $creator)
		{
			if ($creator->support($subjectType))
			{
				return true;
			}
		}
		
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function create($subjectType)
	{
		foreach($this->creators as $creator)
		{
			if ($creator->support($subjectType))
			{
				return $creator->create($subjectType);				
			}
		}
		
		throw new \InvalidateArgumentException("Subject type is not supported.");
	}
}
