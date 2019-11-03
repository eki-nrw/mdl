<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Subject;

use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Eki\NRW\Mdl\MVC\Symfony\View\BaseView;
use Eki\NRW\Mdl\MVC\Symfony\View\EmbedView;
use Eki\NRW\Mdl\MVC\Symfony\View\CachableView;

class SubjectView extends BaseView implements View, SubjectAware, EmbedView, CachableView
{
	use
		EmbedViewTrait,
		SubjectAwareTrait
	;
}
