@extends('layouts.main')

@section('content')

    <h1>แก้ไขโพส</h1>

    <form action="{{ route('posts.update',['post' => $post->id]) }}" method="POST"> {{--ให้มันไปหา post.update เพื่อแก้ไขค่า พร้อมส่งค่าใหม่ไปด้วย--}}
        @method('PUT')
        @csrf {{--สร้าง token พิเศษป้องกันข้อมูล มันจะสร้าง token แต่ละคนไม่เหมือนกันและมีเวลาจำกัดจาก server จะได้ส่งข้อมูลไปหาระบบได้ถูกระบบ--}}

        <div class="form-group">
            <label for="topic">Post Topic</label>
            <input type="text" class="form-control" @error('topic') is-invalid @enderror id="topic" {{--id ต้องชื่อเหมือนกันใน loop for each  --}}
            name="topic" value="{{ old('topic',$post->topic) }}" {{--สร้างชื่อให้ตัวแปร แล้วก็ดัก error ถ้า error ก็ให้แสดงข้อมูลที่ใส่ผิกอยู่ เขียนต่างกับ create นิดหน่อย--}}
                   aria-describedby="topicHelp">
            <small id="topicHelp" class="form-text text-muted">
                Post topic is required
            </small>

            @error('topic')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea  class="form-control" name="content"
                       id="content">{{old('content',$post->content)}}</textarea>

            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        @if(!$attachments->isEmpty())
            @foreach($attachments as $attachment)

                @if ($attachment->file_type === 'application/pdf')
                    <div style="height:600px">
                        <embed src="{{ asset("{$attachment->asset_path}/{$attachment->file_name}") }}" type="{{ $attachment->file_type }}" width="100%" height="600px">
                    </div>
                    <form action="{{route('$attachment.destroy',['$attachment'=> $attachment->id])}}" method="POST">
                        @method('DELETE') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            ลบโพส
                        </button>
                @else
                    <img class="img-thumbnail" src="{{ asset("{$attachment->asset_path}/{$attachment->file_name}") }}" alt="" style="height:60vh">
                @endif

            @endforeach

        @endif

        <button type="submit" class="btn btn-primary">แก้ไข</button>
    </form>

    <hr>

    <h2>DANGER ZONE</h2>
    <form action="{{route('posts.destroy',['post'=> $post->id])}}" method="POST">
        @method('DELETE') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
        @csrf
        <button type="submit" class="btn btn-danger">
            ลบโพส
        </button>
    </form>


@endsection
