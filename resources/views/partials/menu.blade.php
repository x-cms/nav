@forelse($links as $key => $link)
    @if(isset($link['heading']) && $link['heading'] && !$isChildren)
        <li class="header">{{ $link['heading'] or '' }}</li>
    @endif
    @php
        $hasChildren = !$link['children']->isEmpty();
    @endphp
    {{--@if(has_permissions($loggedInUser, $link['permissions']))--}}
    <li class="{{ $hasChildren ? 'treeview' : '' }} {{ (in_array($key, $active)) ? 'active' : '' }}">
        <a href="{{ $link['link'] or '' }}" class="nav-link {{ $hasChildren ? 'nav-toggle' : '' }}">
            <i class="{{ isset($link['icon']) && $link['icon'] ? $link['icon'] : '' }}"></i>
            <span class="title">{{ $link['title'] or '' }}</span>
            @if($hasChildren)
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            @endif
        </a>
        @if($hasChildren)
            <ul class="treeview-menu">
                @include('menu::partials.menu', [
                    'links' => $link['children'],
                    'isChildren' => true,
                    'level' => ($level + 1),
                    'active' => $active,
                ])
            </ul>
        @endif
    </li>
    {{--@endif--}}
@empty

@endforelse
