<?php

namespace Xcms\Nav\Support;

use Xcms\Nav\Models\Nav;
use Xcms\Nav\Models\NavNode;

class NavSupport
{
    /**
     * @var array
     */
    protected $objectInfoByType = [];

    /**
     * @param $type
     * @param \Closure $callback
     * @return $this
     */
    public function registerLinkType($type, \Closure $callback)
    {
        $this->objectInfoByType[$type] = $callback;
        return $this;
    }

    /**
     * @param $type
     * @param array ...$params
     * @return array|null
     */
    public function getObjectInfoByType($type, ...$params)
    {
        if (!array_get($this->objectInfoByType, $type)) {
            return null;
        }
        $result = call_user_func_array($this->objectInfoByType[$type], $params);

        return (array)$result;
    }

    public function render($args = [])
    {
        $slug = array_get($args, 'slug');
        if (!$slug) {
            return null;
        }
        $view = array_get($args, 'view');

        $nav = Nav::where('slug', $slug)->first();
        if (!$nav) {
            return null;
        }

        $navNode = new NavNode();
        $navNodes = $navNode->getNavNodes($nav->id);

        $isChild = false;

        if ($view) {
            return view($view, compact('navNodes', 'nav', 'isChild', 'parentUrl'))->render();
        }
    }

}
