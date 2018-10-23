<!-- BEGIN : GALLERY -->
@if (count($contents))
    <?php $inc = 1; $c = (12/$rwc)?>
    @foreach ($contents as $key => $img)
        @if ($inc == 1)
            <div class="row">
        @endif
        <?php
            $imgDetails = json_decode($img->content, true);
            $cls = 'img-square';
            if ($imgDetails['ict']) {
                $cls = 'img-circle';
            }
        ?>
        <div class="col-xs-6 col-sm-4 col-md-{{$c}}">
            <div class="thumbnail">
                <img class="{{$cls}}" src="{{asset($img->guid)}}" alt="{{$img->name}}">
                <div class="caption" style="text-align: {{$imgDetails['ta']}}">
                    <p style="color:{{$imgDetails['fc']}};"><strong>{{$img->title}}</strong></p>
                    <p style="color:{{$imgDetails['fc']}};">{{$imgDetails['des']}}</p>
                </div>
            </div>
        </div>
        <?php $inc++; ?>
        @if ($inc > $rwc)
            <?php $inc = 1;?>
            </div>
        @endif
    @endforeach
@endif
<!-- END : GALLERY-->