<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Configuration\ConfigResolver;

/**
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
interface ScopeGroupingInterface
{
	/**
	* Returns all group names are related to the given scope
	* 
	* @param string $scope
	* 
	* @return string[]|null
	*/
	public function getGroupNames($scope);
}
