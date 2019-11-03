<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess\Matcher\Map\Http;

use Eki\NRW\Mdl\Contexture\ContextAccess\Matcher\Map\Http as HttpMap;
use Eki\NRW\Mdl\Contexture\ContextAccess\Request;

class URI extends HttpMap
{
    /**
	* @inheritdoc
	* 
	*/
    public function setRequest(Request $request)
    {
        if (!$this->key) {
            sscanf($request->pathinfo, '/%[^/]', $key);
            $this->setMapKey(rawurldecode($key));
        }

        parent::setRequest($request);
    }

    public function getName()
    {
        return 'uri:http:map';
    }

    public function reverseMatch($contextAccessName)
    {
        $matcher = parent::reverseMatch($contextAccessName);
        if ($matcher instanceof self) {
            $request = $matcher->getRequest();
            // Clean up "old" contextaccess prefix and add the new prefix.
            $request->setPathinfo($this->analyseLink($request->pathinfo));
        }

        return $matcher;
    }
}
