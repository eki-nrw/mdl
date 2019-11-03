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
class DelegateSubjectTypeGetter implements SubjectTypeGetterInterface
{
	/**
	* @var SubjectTypeGetterInterface[]
	*/
	private $getters = [];
	
	public function __construct(array $getters = [])
	{
		foreach($getters as $getter)
		{
			if (!$getter instanceof SubjectTypeGetterInterface)
				throw new \InvalidArgumentException(sprintf(
					"Subject getter must be instance of %s. Given %s.",
					SubjectTypeGetterInterface::class, get_class($getter)
				));
				
		}

		$this->getters = $getters;
	}

	/**
	* @inheritdoc
	*/
	public function support($subject)
	{
		foreach($this->getters as $getter)
		{
			if ($getter->support($subject))
			{
				return true;
			}
		}
		
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function getSubjectType($subject)
	{
		foreach($this->getters as $getter)
		{
			if ($getter->support($subject))
			{
				return $getter->getSubjectType($subject);				
			}
		}
		
		throw new \InvalidateArgumentException("Subject is not supported.");
	}
}
