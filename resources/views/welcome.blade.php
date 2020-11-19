@extends('layouts.app')

@section('content')

@php
    $photos = App\Models\Photo::all();
@endphp

<div class="row justify-content-center m-4">
@foreach ($photos as $photo)
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">
                    {{$photo->caption}}
                </h2>
            </div>
            <div class="card-body">
                <img src="/images/posts/{{$photo->photo}}" alt="" srcset="">
            </div>
            <div class="card-footer text-center">
                {{$photo->created_at}}
            </div>
        </div>
    </div>
@endforeach

</div>
<div class="row justify-content-center">
    <a class="btn btn-primary" href="{{route('photos.create')}}" role="button">Add a new Post</a>
</div>

@endsection
