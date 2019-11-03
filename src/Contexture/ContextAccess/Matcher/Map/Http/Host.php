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

class Host extends HttpMap
{
    public function getName()
    {
        return 'host:http:map';
    }

    /**
	* @inheritdoc
	* 
	*/
    public function setRequest(Request $request)
    {
        if (!$this->key) {
            $this->setMapKey($request->host);
        }

        parent::setRequest($request);
    }

    public function reverseMatch($contextAccessName)
    {
        $matcher = parent::reverseMatch($contextAccessName);
        if ($matcher instanceof self) {
            $matcher->getRequest()->setHost($matcher->getMapKey());
        }

        return $matcher;
    }
}
