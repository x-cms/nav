@if(!$collection->isEmpty())
    <ul class="list-unstyled scroller border">
        @foreach($collection as $category)
            <li>
                <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" value="{{ array_get($category, 'id') }}">
                    <span></span>
                    <span class="text">{{ array_get($category, 'name') }}</span>
                </label>
            </li>
            @if(!empty(array_get($category, 'child')))
                @include('nav::partials.checkbox', ['collection' => collect(array_get($category, 'child'))])
            @endif
        @endforeach
    </ul>
@else
    还没有分类，请添加分类
@endif