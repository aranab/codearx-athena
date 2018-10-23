<!-- BEGIN: Item col-6: bootstrap col-md-2 -->
@foreach ($itemContents as $key => $item)
    <div class="col-xs-6 col-sm-4 col-md-2 {{$item['layout']['cls']}}">
        @if ($item['layout']['t'])
            <div class="header-content">
                {{'<'.$item['layout']['tag'].'>'}}{{$item['layout']['t']}}{{'</'.$item['layout']['tag'].'>'}}
            </div>
        @endif
        @if ($item['type'] == 'slider')
            @include('web.typePartial._slider', ['contents' => $item['contents'], 'itemId' => $item['itemId']])
        @elseif ($item['type'] == 'post')
            @include('web.typePartial._post', ['contents' => $item['contents'], 'itemId' => $item['itemId']])
        @elseif ($item['type'] == 'news')
            @include('web.typePartial._news', ['contents' => $item['contents'], 'itemId' => $item['itemId']])
        @elseif ($item['type'] == 'gallery')
            @include('web.typePartial._gallery', ['contents' => $item['contents'], 'itemId' => $item['itemId'], 'rwc' => $item['layout']['rwc']])
        @elseif ($item['type'] == 'profile')
            @include('web.typePartial._profile', ['contents' => $item['contents'], 'itemId' => $item['itemId'], 'rwc' => $item['layout']['rwc']])
        @elseif ($item['type'] == 'banner')
            @include('web.typePartial._banner', ['contents' => $item['contents'], 'itemId' => $item['itemId']])
        @elseif ($item['type'] == 'cForm')
            @include('web.typePartial._cForm', ['contents' => $item['contents'], 'itemId' => $item['itemId']])
        @else
            @include('web.typePartial._post', ['contents' => $item['contents'], 'itemId' => $item['itemId']])
        @endif
    </div>
@endforeach
<!-- END: Item col-6: bootstrap col-md-2 -->
