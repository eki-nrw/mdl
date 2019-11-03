<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess\Matcher\Map\User;

use Eki\NRW\Mdl\Contexture\ContextAccess\Matcher\Map\User as UserMap;
use Eki\NRW\Mdl\Contexture\ContextAccess\Request;

class Email extends UserMap
{
    public function getName()
    {
        return 'email:user:map';
    }

    /**
	* @inheritdoc
	* 
	*/
    public function setRequest(Request $request)
    {
        if (!$this->key) {
            $this->setMapKey($request->email);
        }

        parent::setRequest($request);
    }

    public function reverseMatch($contextAccessName)
    {
        $matcher = parent::reverseMatch($contextAccessName);
        if ($matcher instanceof self) {
            $matcher->getRequest()->setEmail($matcher->getMapKey());
        }

        return $matcher;
    }
}
