@extends('layouts.layout')
@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Shorter Url
        </div>
        <div class="app">
            <form class="row g-3" action="/save" method="post">
                @csrf
                <div class="col-auto">
                    <input class="form-control" type="text" name="long_url" placeholder="Past Long URL">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Create Short URL</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
