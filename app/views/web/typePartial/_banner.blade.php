<!-- BEGIN: BANNER -->
@if (count($contents))
    <div id="s_{{$itemId}}" class="carousel slide">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="first-slide" src="{{asset($contents->guid)}}"
                     alt="{{$contents->name}}">
                <div class="container">
                    <?php $details = json_decode($contents->content, true); ?>
                    <div class="carousel-caption" style="text-align:{{$details['ta']}};bottom:{{$details['pb']}}; left:{{$details['pl']}}; right:{{$details['pr']}};">
                        @if ($contents->title)
                        {{'<'.$details['tTag'].' style=color:'.$details['tfc'].';font-size:'.$details['tfs'].';>'}}<span class="title">{{$contents->title}}</span>{{'</'.$details['tTag'].'>'}}
                        @endif
                        @if ($details['des'])
                        {{'<'.$details['dTag'].' style=color:'.$details['dfc'].';font-size:'.$details['dfs'].';>'}}<span class="des">{{$details['des']}}</span>{{'</'.$details['dTag'].'>'}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- END: BANNER -->