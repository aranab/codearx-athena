<!-- BEGIN : POST CONTENT -->
@if (count($contents))
    @if ($contents[0]->title)
    <div class="header-content">
        <h1>{{$contents[0]->title}}</h1>
    </div>
    @endif
    {{$contents[0]->content}}
@endif
<!-- END : POST CONTENT -->