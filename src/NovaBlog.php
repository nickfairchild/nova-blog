<?php

namespace Nickfairchild\NovaBlog;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaBlog extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-blog', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-blog', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        if (config('nova-blog.render-navigation')) {
            return view('nova-blog::navigation');
        }
    }
}
