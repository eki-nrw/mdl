<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Plan;

use Eki\NRW\Mdl\Working\Subject\SubjecTypeGetter as BaseSubjectTypeGetter;
use Eki\NRW\Mdl\Working\PlanInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class SubjectTypeGetter extends BaseSubjectTypeGetter
{
	public function __construct()
	{
		parent::__construct(
			PlanInterface::class,
			function ($subject) {
				if (null !== ($planType = $subject->getPlanType()))
					return $planType->getPlanType();
				else
					return null;
			}
		);
	}
}
