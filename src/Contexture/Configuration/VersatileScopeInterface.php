<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Configuration;

/**
 * Allows a ConfigResolver to dynamically change their default scope.
 * 
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
interface VersatileScopeInterface extends ConfigResolverInterface
{
    /**
     * Returns current default scope.
     *
     * @return string
     */
    public function getDefaultScope();

    /**
     * Sets a new default scope.
     *
     * @param string $scope
     */
    public function setDefaultScope($scope);
}
