<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame\Pass;

use Eki\NRW\Mdl\Processing\Actuate\ActuateByActuatorTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Pass extends AbstractPass
{
	use	
		ActuateByActuatorTrait
	;
}
