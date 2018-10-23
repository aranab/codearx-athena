<!-- BEGIN: Item col-1: bootstrap col-md-12 -->
<div class="{{$itemContents[0]['layout']['cls']}}">
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
        @include('web.typePartial._gallery', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId'], 'rwc' => $itemContents[0]['layout']['rwc'], 'bc' => $itemContents[0]['layout']['bc']])
    @elseif ($itemContents[0]['type'] == 'profile')
        @include('web.typePartial._profile', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId'], 'rwc' => $itemContents[0]['layout']['rwc'], 'bc' => $itemContents[0]['layout']['bc']])
    @elseif ($itemContents[0]['type'] == 'banner')
        @include('web.typePartial._banner', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @elseif ($itemContents[0]['type'] == 'cForm')
        @include('web.typePartial._cForm', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @else
        @include('web.typePartial._post', ['contents' => $itemContents[0]['contents'], 'itemId' => $itemContents[0]['itemId']])
    @endif
</div>
<!-- END: Item col-1: bootstrap col-md-12 -->
