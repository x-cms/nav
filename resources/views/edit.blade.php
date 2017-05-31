@extends('base::layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/nestable/jquery.nestable.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/core/css/nav-nestable.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box-group" id="accordion">
                <div class="box box-primary box-link-navs" data-type="page" data-type-text="页面">
                    <div class="box-header with-border">
                        <h3 class="box-title">页面</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(!$pages->isEmpty())
                            <ul class="list-unstyled scroller border">
                                @foreach($pages as $pages)
                                    <li>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="{{ $pages->id }}">
                                            <span></span>
                                            <span class="text">{{ $pages->title }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            还没有页面，请添加页面
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="text-right">
                            <button class="btn btn-primary add-item" type="submit">
                                <i class="fa fa-plus"></i> 添加到导航
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box box-primary box-link-navs" data-type="category" data-type-text="分类">
                    <div class="box-header with-border">
                        <h3 class="box-title">分类</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('nav::partials.category', ['collection' => $categories])
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="text-right">
                            <button class="btn btn-primary add-item" type="submit">
                                <i class="fa fa-plus"></i> 添加到导航
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box box-primary box-link-navs" data-type="tag"  data-type-text="标签">
                    <div class="box-header with-border">
                        <h3 class="box-title">标签</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        @if(!$tags->isEmpty())
                            <ul class="list-unstyled scroller border">
                                @foreach($tags as $tag)
                                    <li>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" value="{{ $tag->id }}">
                                            <span></span>
                                            <span class="text">{{ $tag->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            还没有标签，请添加标签
                        @endif
                    </div>
                    <div class="box-footer">
                        <div class="text-right">
                            <button class="btn btn-primary add-item" type="submit">
                                <i class="fa fa-plus"></i> 添加到导航
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box box-primary box-link-navs" data-type="custom-link" data-type-text="自定义链接">
                    <div class="box-header with-border">
                        <h3 class="box-title">外部链接</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">链接标题</label>
                            <input type="text"
                                   class="form-control"
                                   placeholder=""
                                   value=""
                                   name=""
                                   data-field="title"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label">链接地址</label>
                            <input type="text"
                                   class="form-control"
                                   placeholder="http://"
                                   value=""
                                   name=""
                                   data-field="url"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label">链接图标</label>
                            <input type="text"
                                   class="form-control"
                                   placeholder="fa fa-times"
                                   value=""
                                   name=""
                                   data-field="icon_font"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label">css样式</label>
                            <input type="text"
                                   class="form-control"
                                   placeholder=""
                                   value=""
                                   name=""
                                   data-field="css_class"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label">打开方式</label>
                            <select class="form-control" data-field="target">
                                <option value="">默认</option>
                                <option value="_self">_self</option>
                                <option value="_blank">_blank</option>
                                <option value="_parent">_parent</option>
                                <option value="_top">_top</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="text-right">
                            <button class="btn btn-primary add-item" type="submit">
                                <i class="fa fa-plus"></i> 添加到导航
                            </button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <form class="form-horizontal form-bordered" method="post" action="{{ route('navs.update', ['id' => $nav->id]) }}">
                {{ csrf_field() }}
                <textarea name="nav_structure"
                          id="nav_structure"
                          class="hidden"
                          style="display: none;">{!! $navStructure or '[]' !!}</textarea>
                <textarea name="deleted_nodes"
                          id="deleted_nodes"
                          class="hidden"
                          style="display: none;">[]</textarea>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">基本信息</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">导航名称</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="name"
                                       title="name"
                                       class="form-control"
                                       autocomplete="off"
                                       value="{{ $nav->name }}"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">别名</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="slug"
                                       title="slug"
                                       class="form-control"
                                       autocomplete="off"
                                       value="{{ $nav->slug }}"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">排序</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="order"
                                       title="order"
                                       class="form-control"
                                       autocomplete="off"
                                       value="{{ $nav->order }}"
                                >
                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-2 control-label">导航结构</label>
                            <div class="col-md-6">
                                <div class="dd nestable-nav">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <a class="btn btn-primary" href="{{ route('navs.index') }}">返回列表</a>
                            <button type="submit" class="btn btn-primary">确认提交</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/x-custom-template" id="navs_template_list_group">
        <ol class="dd-list"></ol>
    </script>
    <script type="text/x-custom-template" id="navs_template_list_item">
        <li class="dd-item dd3-item">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <span class="text pull-left">__title__</span>
                <span class="text pull-right">__type__</span>
                <a href="javascript:;" title="Toggle item details" class="show-item-details">
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="item-details">
                <div class="fields">
                    <label data-field="title">
                        <span class="text">链接标题</span>
                        <input type="text" value="">
                    </label>
                    <label data-field="url">
                        <span class="text">链接地址</span>
                        <input type="text" value="">
                    </label>
                    <label data-field="css_class">
                        <span class="text">CSS样式</span>
                        <input type="text" value="">
                    </label>
                    <label data-field="icon_font">
                        <span class="text">链接图标</span>
                        <input type="text" value="">
                    </label>
                    <label data-field="target">
                        <span class="text">打开方式</span>
                        <select class="form-control">
                            <option value="">默认</option>
                            <option value="_self">_self</option>
                            <option value="_blank">_blank</option>
                            <option value="_parent">_parent</option>
                            <option value="_top">_top</option>
                        </select>
                    </label>
                </div>
                <div class="text-right">
                    <a href="#" title="" class="btn btn-danger btn-sm">移除</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </li>
    </script>
@endsection

@push('scripts')
<script src="//cdn.bootcss.com/underscore.js/1.8.3/underscore-min.js"></script>
<script src="//cdn.bootcss.com/Nestable/2012-10-15/jquery.nestable.min.js"></script>
<script src="{{ asset('vendor/core/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.js') }}"></script>
<script src="{{ asset('vendor/core/js/edit-nav.js') }}"></script>
@endpush

@push('js')
<script>
    $(".scroller").mCustomScrollbar({
        theme: "minimal-dark",
        autoHideScrollbar: true
    });
</script>
@endpush