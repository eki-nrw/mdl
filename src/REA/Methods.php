<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
final class Methods
{
	const INPUT_USE = 'use';
	const INPUT_CONSUME = 'consume';
	const INPUT_CITE = 'cite';
	const INPUT_WORK = 'work';
	const INPUT_ACCEPT = 'accept';      // to be prepair/maintain
	const INPUT_LOAD = 'load';          // transport, to be changed location

	const OUTPUT_PRODUCE = 'produce';   // create new
	const OUTPUT_IMPROVE = 'improve';   // repair, maintenance
	const OUTPUT_UNLOAD = 'unload';     // transport
}
