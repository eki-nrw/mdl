<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Action;

use Eki\NRW\Mdl\MVC\Symfony\View\SubjectView;

class ActionView extends SubjectView implements ActionAware
{
	use
		ActionAwareTrait
	;
}
