@extends('layouts.main')

@section('content')
    <h1>{{$post->topic}}</h1>


    @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
           {{--บอกว่าให้ไปหน้า edit หน้า edit ต้องการ para ของ post ก็ให้ค่าไปด้วย โดยการส่งใช้ค่า id --}}
        class="btn btn-info">
            แก้ไขโพสนี้
        </a>
    @endcan

    <p>Create: {{$post->created_at}}</p>
    <p>View: {{ $post->view_count }}</p>

    <p>{{ $post->content }}</p>






@endsection
