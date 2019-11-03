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

class Port extends HttpMap
{
    public function getName()
    {
        return 'port';
    }

    /**
	* @inheritdoc
	* 
	*/
    public function setRequest(Request $request)
    {
        if (!$this->key) {
            if (!empty($request->port)) {
                $key = $request->port;
            } else {
                switch ($request->scheme) {
                    case 'https':
                        $key = 443;
                        break;

                    case 'http':
                    default:
                        $key = 80;
                }
            }

            $this->setMapKey($key);
        }

        parent::setRequest($request);
    }

    public function reverseMatch($contextAccessName)
    {
        $matcher = parent::reverseMatch($contextAccessName);
        if ($matcher instanceof self) {
            $matcher->getRequest()->setPort($matcher->getMapKey());
        }

        return $matcher;
    }
}
