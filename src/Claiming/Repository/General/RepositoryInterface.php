<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository\General;

use Eki\NRW\Mdl\Claiming\Repository\RepositoryInterface as BaseRepositoryInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface RepositoryInterface extends BaseRepositoryInterface
{
	/**
	* Returns find service
	* 
	* @return FindServiceInterface
	*/
	public function getFindService();
	
	/**
	* Returns persistence service
	* 
	* @return PersistenceServiceInterface
	*/
	public function getPersistenceService();
}
