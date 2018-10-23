<!-- BEGIN : SLIDER 'carousel slide'-->
@if (count($contents))
    <div id="s_{{$itemId}}" class="carousel slide" data-ride="carousel">

    <?php $len = sizeof($contents); ?>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @for ($i = 0; $i < $len; $i++)
            @if ($i == 0)
                <li data-target="#s_{{$itemId}}" data-slide-to="{{$i}}" class="active"></li>
            @else
                <li data-target="#s_{{$itemId}}" data-slide-to="{{$i}}"></li>
            @endif
        @endfor
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach ($contents as $key => $slide)
            @if ($key == 0)
                <div class="item active">
                    <img class="first-slide" src="{{asset($slide->path.$slide->id.$slide->ext)}}"
                         alt="{{$slide->pic_name}}">
                    <div class="container">
                        <?php $details = json_decode($slide->content, true); ?>
                        <div class="carousel-caption" style="bottom:{{$details['pb']}}; left:{{$details['pl']}}; right:{{$details['pr']}};">
                            <h1 style="color:{{$details['tc']}};">{{$slide->title}}</h1>
                            {{$slide->description}}
                        </div>
                    </div>
                </div>
            @else
                <div class="item">
                    <img class="first-slide" src="{{asset($slide->path.$slide->id.$slide->ext)}}"
                         alt="{{$slide->pic_name}}">
                    <div class="container">
                        <?php $details = json_decode($slide->content, true); ?>
                        <div class="carousel-caption" style="bottom:{{$details['pb']}}; left:{{$details['pl']}}; right:{{$details['pr']}};">
                            <h1 style="color:{{$details['tc']}};">{{$slide->title}}</h1>
                            {{$slide->description}}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Controls -->
        <a class="left carousel-control" href="#s_{{$itemId}}" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#s_{{$itemId}}" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endif
<!-- END: SLIDER 'carousel slide'-->
