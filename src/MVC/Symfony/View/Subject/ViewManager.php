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

use Eki\NRW\Mdl\MVC\Symfony\View\AbstractViewManager;

class ViewManager extends AbstractViewManager
{
    protected function newView($obj, $viewType, array $parameters)
    {
        $view = new SubjectView(null, $parameters, $viewType);
        $view->setSubject($obj);
        
        return $view;
	}
}
