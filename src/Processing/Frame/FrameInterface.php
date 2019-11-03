<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Frame;

use Eki\NRW\Mdl\Processing\FrameInterface as BaseFrameInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface FrameInterface extends BaseFrameInterface
{
	const FRAME_TYPE_PASS = "pass";
	const FRAME_TYPE_PROCESS = "process";
	const FRAME_TYPE_EXCHANGE = "exchange";
}
