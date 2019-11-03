<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess\Request;

use Eki\NRW\Mdl\Contexture\ContextAccess\Request;

/**
 * @property-read string $login 
 * @property-read string $email 
 */
class UserRequest extends Request
{
    /**
     * The login of the user.
     *
     * @var string
     */
    protected $login;

    /**
     * The email
     *
     * @var string
     */
    protected $email;
    
    public function setLogin($login)
    {
		$this->login = $login;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
}
