<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess\Matcher\Map;

use Eki\NRW\Mdl\Contexture\ContextAccess\Matcher\Map as BaseMap;
use Eki\NRW\Mdl\Contexture\ContextAccess\Request\HttpRequest;

abstract class Http extends BaseMap
{
    /**
	* @inheritdoc
	* 
	*/
    public function setRequest(Request $request)
    {
    	if (!$request instanceof HttpRequest)
    		throw new \InvalidArgumentException(sprintf("Request must be instance of %s.", HttpRequest::class));
    	
        parent::setRequest($request);
    }
}
