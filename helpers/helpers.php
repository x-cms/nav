<?php

if (!function_exists('nav')) {
    function nav()
    {
        return \Xcms\Nav\Facades\NavFacade::getFacadeRoot();
    }
}

if (!function_exists('is_nav_item_active')) {
    function is_nav_item_active($node, $type, $relatedId)
    {

        if (request()->url() === url($node->url)) {
            return true;
        }

        return false;
    }
}