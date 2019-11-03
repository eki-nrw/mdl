<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Controller;

use Eki\NRW\Mdl\MVC\Symfony\Controller\Controller;
use Eki\NRW\Mdl\MVC\Symfony\View\View;

/**
 * This controller provides the view feature.
 *
 */
class ViewController extends Controller
{
    /**
     * This is the default view action or a SubjectView object.
     *
     * It doesn't do anything by itself: the returned View object is rendered by the ViewRendererListener
     * into an HttpFoundation Response.
     *
     * This action can be selectively replaced by a custom action by means of content_view
     * configuration. Custom actions can add parameters to the view and customize the Response the View will be
     * converted to. They may also bypass the ViewRenderer by returning an HttpFoundation Response.
     *
     * Cache is in both cases handled by the CacheViewResponseListener.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\View
     */
    public function viewAction(View $view)
    {
        return $view;
    }

    /**
     * Embed a content.
     * Behaves mostly like viewAction(), but with specific content load permission handling.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\View
     */
    public function embedAction(View $view)
    {
        return $view;
    }
}
