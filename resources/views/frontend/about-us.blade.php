@extends('frontend.layouts.main')
@section('aboutUs')

    <main class="main">
        <div class="container">
            <h3 class="text-center main__tiltle pt-4">{{$introduce->title}}</h3>
            <div class="aboutUs text-justify content pt-4 ">{!! $introduce->description !!}</div>
        </div>
    </main>

@endsection
