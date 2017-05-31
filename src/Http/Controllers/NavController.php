<?php

namespace Xcms\Nav\Http\Controllers;

use Illuminate\Http\Request;
use Xcms\Base\Http\Controllers\SystemController;
use Xcms\Blog\Models\Category;
use Xcms\Blog\Models\Tag;
use Xcms\Nav\Models\Nav;
use Xcms\Nav\Models\NavNode;
use Xcms\Page\Models\Page;

class NavController extends SystemController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function (Request $request, $next) {

            menu()->setActiveItem('navs');

            $this->breadcrumbs
                ->addLink('内容管理')
                ->addLink('导航列表', route('navs.index'));

            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return Nav::all()->toJson();
        }

        $this->setPageTitle('导航管理');
        return view('nav::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('添加导航');
        $pages = Page::all();
        $categories = collect(Category::renderAsArray());
        $tags = Tag::all();

        return view('nav::create', compact('pages', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nav = new Nav();
        $navNode = new NavNode();
        $nav->name = $request->name;
        $nav->slug = $request->slug;
        $nav->order = $request->order;
        $nav->save();

        $result = $nav->id;

        $navStructure = json_decode($request->get('nav_structure'), true);

        foreach ($navStructure as $order => $node){
            $navNode->updateNavNode($result, $node, $order);
        }

        return redirect()->route('navs.index')->with('success_msg', '添加导航成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->setPageTitle('编辑导航');
        $nav = Nav::find($id);
        $navNode = new NavNode();
        $pages = Page::all();
        $categories = collect(Category::renderAsArray());
        $tags = Tag::all();
        $navStructure = json_encode($navNode->getNavNodes($id));

        return view('nav::edit', compact('nav', 'pages', 'categories', 'tags', 'navStructure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nav = Nav::find($id);
        $navNode = new NavNode();
        $nav->name = $request->name;
        $nav->slug = $request->slug;
        $nav->order = $request->order;

        $nav->save();

        $result = $nav->id;

        $navStructure = json_decode($request->get('nav_structure'), true);
        $deletedNodes = json_decode($request->get('deleted_nodes'), true);

        if($deletedNodes) {
            $navNode->destroy($deletedNodes);
        }

        if ($navStructure !== null) {
            foreach ($navStructure as $order => $node) {
                $navNode->updateNavNode($result, $node, $order);
            }
        }

        return redirect()->route('navs.index')->with('success_msg','编辑导航成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nav::destroy($id);
        return response()->json(['code' => 200, 'message' => '删除导航成功']);
    }
}
