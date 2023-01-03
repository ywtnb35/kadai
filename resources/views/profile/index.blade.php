@extends('layouts.front')

@section('content')
    <div class="container">
        <p>プロフィール</p>
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class"name p-2">
                                    <h1>{{ Str::limit($headline->name, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="caption mx-auto">
                                <div class="gender p-2">
                                    <h1>{{ Str::limit($headline->gender,70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="caption mx-auto">
                                <div class="hobby p-2">
                                    <h1>{{ Str::limit($headline->hobby,70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <p class="introduction mx-auto">{{ Str::limit($headline->introduction, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ str::limit($post->name, 10) }}
                                </div>
                                <div class="gender">
                                    {{ str::limit($post->gender,10) }}
                                </div>
                                <div class="hobby">
                                    {{ str::limit($post->hobby,100) }}
                                </div>
                                <div class="introduction mt-3">
                                     {{ Str::limit($post->introduction, 1500) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
@endsection