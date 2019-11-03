<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\WorkingSubject;

use Eki\NRW\Mdl\Working\WorkingSubjectInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface WorkingDirectorAwareInterface
{
	public function setWorkingDirector(WorkingDirectorInterface $workingDirector = null);
}
