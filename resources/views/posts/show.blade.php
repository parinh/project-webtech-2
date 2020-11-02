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

    @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
    <form action="{{route('posts.attachmentUpdate',['id'=> $post->id])}}" method="POST" enctype="multipart/form-data">
        @method('PUT') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
        @csrf
        <p>Select file to upload:</p>
        <input   type="file" name="uploaded_file" id="file">


        <button type="submit" class="btn btn-primary">สร้าง</button>
    </form>
    @endcan

    <p>Create: {{$post->created_at}}</p>
    <p>View: {{ $post->view_count }}</p>

    <p>{{ $post->content }}</p>


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
            <button type="submit" class="btn btn-danger">
                ลบรูป
            </button>
        </form>
        @endcan

    @else
        <img class="img-thumbnail" src="{{ asset("{$attachment->asset_path}/{$attachment->file_name}") }}" alt="" style="height:60vh">

        @can('update',$post)  {{--ไปดูหน้า provider มันจะเลิือกใช้ abili ตามที่ตั้งไว้ก็เขียนว่าจะใช้อันไหน--}}
        <form action="{{route('attachments.destroy',['attachment'=> $attachment->id])}}" method="POST">
            @method('DELETE') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
            @csrf
            <button type="submit" class="btn btn-danger">
                ลบรูป 
            </button>
        </form>
        @endcan

    @endif

    @endforeach


@endif







@endsection
<script>
    import Button from "../../js/Jetstream/Button";
    export default {
        components: {Button}
    }
</script>
