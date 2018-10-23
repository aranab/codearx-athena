@extends('web.layout')

@section('title', $pageTitle)
@section('mDes', $arr['mDes'])
@section('mAuth', $arr['mAuth'])
@section('cTag')
    @if ($arr['cTag'])
        <link rel="canonical" href="{{$arr['cTag']}}" />
    @endif
@stop

@section('content')
    @foreach($sections as $key => $sec)
        <!-- BEGIN: Section -->
        <section style="background-color:{{$sec['layout']['bc']}}; color:{{$sec['layout']['fc']}};">
            <div class="{{$sec['layout']['cls']}}">
                <div class="">
                    @if ($sec['layout']['l'] == 'col-1')
                        @include('web.columns._col_1', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-2')
                        @include('web.columns._col_2', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-3')
                        @include('web.columns._col_3', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-4')
                        @include('web.columns._col_4', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-6')
                        @include('web.columns._col_6', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-93')
                        @include('web.columns._col_93', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-39')
                        @include('web.columns._col_39', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-84')
                        @include('web.columns._col_84', ['itemContents' => $itemContents[$sec['secId']]])
                    @elseif ($sec['layout']['l'] == 'col-48')
                        @include('web.columns._col_48', ['itemContents' => $itemContents[$sec['secId']]])
                    @else
                        @include('web.columns._col_1', ['itemContents' => $itemContents[$sec['secId']]])
                    @endif
                </div>
            </div>
        </section>
        <!-- END: Section -->
        @if ($sec['layout']['bs'])
            <!-- BEGIN: Separator -->
            <div class="web-separator web-green"></div>
            <!-- END: Separator -->
        @endif
    @endforeach

    @if ($widget['on'])
        <!-- BEGIN SEPARATOR -->
        <div class="web-separator web-green"></div>
        <!-- END SEPARATOR -->

        <!-- BEGIN: Footer Widget -->
        <section class="web-white">
            <div class="area container">
                <div class="header-content">
                    <h1 class="font-blue-dark">{{$widget['content']->title}}</h1>
                </div>
                <div class="row">{{$widget['content']->content}}</div>
            </div>
        </section>
        <!-- END: Footer Widget -->
    @endif
@stop


