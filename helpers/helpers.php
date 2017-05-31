<?php

if (!function_exists('nav')) {
    function nav()
    {
        return \Xcms\Nav\Facades\NavFacade::getFacadeRoot();
    }
}