<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Exception;

use InvalidArgumentException;

/**
 * This exception is thrown when a dynamic parameter could not be found in any scope.
 */
class ParameterNotFoundException extends InvalidArgumentException
{
    public function __construct($paramName, $namespace, array $triedScopes = array())
    {
        $this->message = "Parameter '$paramName' with namespace '$namespace' could not be found.";
        if (!empty($triedScopes)) {
            $this->message .= ' Tried scopes: ' . implode(', ', $triedScopes);
        }
    }
}
