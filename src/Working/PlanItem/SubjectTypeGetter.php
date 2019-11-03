<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\PlanItem;

use Eki\NRW\Mdl\Working\SubjecTypeGetter as BaseSubjectTypeGetter;
use Eki\NRW\Mdl\Working\PlanItemInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class SubjectTypeGetter extends BaseSubjectTypeGetter
{
	public function __construct()
	{
		parent::__construct(
			PlanItemInterface::class,
			function ($subject) {
				if (null !== ($planItemType = $subject->getPlanItemType()))
					return $planItemType->getPlanItemType();
				else
					return null;
			}
		);
	}
}
