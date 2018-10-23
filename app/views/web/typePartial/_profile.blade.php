<!-- BEGIN : PROFILE GALLERY -->
@if (count($contents))
    <?php $inc = 1; $c = (12/$rwc)?>
    <div class="row">
        @foreach ($contents as $key => $prf)
            <?php
            $prfDetails = json_decode($prf->content, true);
            $cls = 'img-square';
            if ($prfDetails['ict']) {
                $cls = 'img-circle';
            }
            ?>
            <div class="col-xs-6 col-sm-4 col-md-{{$c}} {{$prfDetails['cls']}}">
                <div class="thumbnail" style="background-color:{{$bc}}">
                    @if ($prfDetails['ilp'])
                        <a href="{{url('/profile', $prf->id)}}">
                            @endif
                            <img class="{{$cls}}" src="{{asset($prf->guid)}}" alt="{{$prf->name}}">
                            <div class="leader-caption" style="text-align: {{$prfDetails['ta']}}">
                                <p style="color:{{$prfDetails['ttc']}}; font-size:{{$prfDetails['tts']}};"><strong>{{$prf->title}}</strong></p>
                                <p style="color:{{$prfDetails['stc']}}; font-size:{{$prfDetails['sts']}};"><span>{{$prfDetails['sDes']}}</span></p>
                            </div>
                            @if ($prfDetails['ilp'])
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
<!-- END : PROFILE GALLERY -->