<!-- BEGIN: Item col-2: bootstrap col-md-6 -->
<div class="col-xs-12 col-sm-6 col-md-6 {{$itemContents[0]['layout']['cls']}}">
    @if ($itemContents[0]['layout']['t'])
        <div class="header-content">
            {{'<'.$itemContents[0]['layout']['tag'].'>'}}{{$itemContents[0]['layout']['t']}}{{'</'.$itemContents[0]['layout']['tag'].'>'}}
        </div>
    @endif
    @if ($itemContents[0]['type'] == 'slider')
        @include('web.typePartial._slider', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @elseif ($itemContents[0]['type'] == 'post')
        @include('web.typePartial._post', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @elseif ($itemContents[0]['type'] == 'news')
        @include('web.typePartial._news', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @elseif ($itemContents[0]['type'] == 'gallery')
        @include('web.typePartial._gallery', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId'], 'rwc' => $itemContents[0]['layout']['rwc']])
    @elseif ($itemContents[0]['type'] == 'profile')
        @include('web.typePartial._profile', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId'], 'rwc' => $itemContents[0]['layout']['rwc']])
    @elseif ($itemContents[0]['type'] == 'banner')
        @include('web.typePartial._banner', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @elseif ($itemContents[0]['type'] == 'cForm')
        @include('web.typePartial._cForm', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @else
        @include('web.typePartial._post', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @endif
</div>
<!-- END: Item col-2: bootstrap col-md-6 -->

<!-- BEGIN: Item col-2: bootstrap col-md-6 -->
<div class="col-xs-12 col-sm-6 col-md-6 {{$itemContents[1]['layout']['cls']}}">
    @if ($itemContents[1]['layout']['t'])
        <div class="header-content">
            {{'<'.$itemContents[1]['layout']['tag'].'>'}}{{$itemContents[1]['layout']['t']}}{{'</'.$itemContents[1]['layout']['tag'].'>'}}
        </div>
    @endif
    @if ($itemContents[1]['type'] == 'slider')
        @include('web.typePartial._slider', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId']])
    @elseif ($itemContents[1]['type'] == 'post')
        @include('web.typePartial._post', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId']])
    @elseif ($itemContents[1]['type'] == 'news')
        @include('web.typePartial._news', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId']])
    @elseif ($itemContents[1]['type'] == 'gallery')
        @include('web.typePartial._gallery', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId'], 'rwc' => $itemContents[1]['layout']['rwc']])
    @elseif ($itemContents[1]['type'] == 'profile')
        @include('web.typePartial._profile', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId'], 'rwc' => $itemContents[1]['layout']['rwc']])
    @elseif ($itemContents[1]['type'] == 'banner')
        @include('web.typePartial._banner', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId']])
    @elseif ($itemContents[0]['type'] == 'cForm')
        @include('web.typePartial._cForm', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @else
        @include('web.typePartial._post', ['contents' => $itemContents[1]['contents'], 'itemId' => $itemContents[1]['itemId']])
    @endif
</div>
<!-- END: Item col-2: bootstrap col-md-6 -->
