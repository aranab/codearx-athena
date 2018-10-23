<!-- BEGIN : NEWSLETTER -->
@if (count($contents))
    <ul class="padding-left-off">
        @foreach($contents as $key => $content)
            <li>
                <h5 class="inline">
                    <i class="fa fa-circle" aria-hidden="true"></i>
                    {{$content->title}}
                </h5>
                <p>
                    @if (strlen($content->content > 200))
                        {{Str::limit(strip_tags($content->content, '<img>'), $limit = 200, $end = '....<a href="'.url('/news', $content->id).'" class="read-more-font-color">Read More</a>')}}
                    @else
                        {{strip_tags($content->content, '<img>')}}....<a href="{{url('/news', $content->id)}}" class="read-more-font-color">Read More</a>
                    @endif
                </p>
                <div class="clearfix"></div>
            </li>
        @endforeach
    </ul>
    <a href="{{url('/news')}}" class="read-more-font-color">ALL RESEARCH</a>
@endif
<!-- END : NEWSLETTER -->