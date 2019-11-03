<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository\General\InMemory;

use Eki\NRW\Mdl\Claiming\Repository\General\Repository as BaseRepository;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Repository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(
			new PersistenceService(),
			new FindService($this)
		);
	}
}
