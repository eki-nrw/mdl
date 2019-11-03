<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
final class MVCEvents
{
    /**
     * The PRE_SUBJECT_VIEW event occurs right before a view is rendered for a subject, via the subject view controller.
     * This event is triggered by the view manager and allows you to inject additional parameters to the subject view template.
     *
     * The event listener method receives a \Eki\NRW\Mdl\MVC\Symfony\Event\PreViewEvent
     *
     * @see Eki\NRW\Mdl\MVC\Symfony\View\Manager
     */
    const PRE_SUBJECT_VIEW = 'eki_nrw.pre_subject_view';
}
