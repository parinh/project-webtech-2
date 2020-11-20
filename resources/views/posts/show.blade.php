
@extends('layouts.main')

@section('content')
    <div class="text-white mt-5">
        <h1>{{$post->topic}}</h1>
    </div>
    <hr>
    <button class="btn btn-primary">Create: {{$post->created_at}}</button>
    <button class="btn btn-info">View: {{ $post->view_count }}</button>


    @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
           {{--บอกว่าให้ไปหน้า edit หน้า edit ต้องการ para ของ post ก็ให้ค่าไปด้วย โดยการส่งใช้ค่า id --}}
        class="btn btn-warning">
            Edit Post
        </a>
    @endcan

    @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
    <form action="{{route('posts.attachmentUpdate',['id'=> $post->id])}}" method="POST" enctype="multipart/form-data">
        @method('PUT') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
        @csrf
        <p class="mt-3 text-white">Select file to Add more files:</p>
        <input  class="btn btn-secondary" type="file" name="uploaded_file" id="file">


        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    @endcan



    <p class="mt-5" style="font-size: 25px">{{ $post->content }}</p>


@if(!$attachments->isEmpty())
    @foreach($attachments as $attachment)

    @if ($attachment->file_type === 'application/pdf')
        <div style="height:600px">
            <embed src="{{ asset("{$attachment->asset_path}/{$attachment->file_name}") }}" type="{{ $attachment->file_type }}" width="100%" height="600px">
        </div>

        @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
        <form action="{{route('attachments.destroy',['attachment'=> $attachment->id])}}" method="POST">
            @method('DELETE') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
            @csrf
            <button type="submit" class="btn btn-danger mt-3">
                Delete File
            </button>
        </form>
        @endcan

    @else
        <img class="img-thumbnail" src="{{ asset("{$attachment->asset_path}/{$attachment->file_name}") }}" alt="" style="height:60vh">

        @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
        <form action="{{route('attachments.destroy',['attachment'=> $attachment->id])}}" method="POST">
            @method('DELETE') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
            @csrf
            <button type="submit" class="btn btn-danger mt-3">
                Delete File
            </button>
        </form>
        @endcan

    @endif

    @endforeach

@endif

    @foreach($comments as $comment) {{--loop ที่ให้ค่าเข้ามาวน ตัวเดียววนในตัวเยอะ--}}
    <div class="row">
        <div class="card mb-3 col-sm bg-dark text-white shadow-lg mb-5 rounded" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->commentname }}</h5> {{--เอามาบางค่า--}}
                <p class="card-text">{{ $comment->sentence }}</p>
            </div>
        </div>
    </div>
    @endforeach









@endsection
<script>
    import Button from "../../js/Jetstream/Button";
    export default {
        components: {Button}
    }
</script>
