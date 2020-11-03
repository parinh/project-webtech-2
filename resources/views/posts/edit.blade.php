@extends('layouts.main')

@section('content')

    <h1 class="text-white mt-5">Edit Post</h1>
    <hr>

    <form action="{{ route('posts.update',['post' => $post->id]) }}" method="POST"> {{--ให้มันไปหา post.update เพื่อแก้ไขค่า พร้อมส่งค่าใหม่ไปด้วย--}}
        @method('PUT')
        @csrf {{--สร้าง token พิเศษป้องกันข้อมูล มันจะสร้าง token แต่ละคนไม่เหมือนกันและมีเวลาจำกัดจาก server จะได้ส่งข้อมูลไปหาระบบได้ถูกระบบ--}}

        <div class="form-group">
            <label style="font-size: 20px" for="topic">Subject Name</label>
            <input type="text" class="form-control" @error('topic') is-invalid @enderror id="topic" {{--id ต้องชื่อเหมือนกันใน loop for each  --}}
            name="topic" value="{{ old('topic',$post->topic) }}" {{--สร้างชื่อให้ตัวแปร แล้วก็ดัก error ถ้า error ก็ให้แสดงข้อมูลที่ใส่ผิกอยู่ เขียนต่างกับ create นิดหน่อย--}}
                   aria-describedby="topicHelp">
            <small id="topicHelp" class="form-text text-muted">
                Subject Name is required
            </small>

            @error('topic')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group">
            <label style="font-size: 20px" for="content">Detail</label>
            <textarea  class="form-control" name="content"
                       id="content">{{old('content',$post->content)}}</textarea>

            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>



        <button type="submit" class="btn btn-success">Edit</button>
    </form>

    <hr>

    <form action="{{route('posts.destroy',['post'=> $post->id])}}" method="POST">
        @method('DELETE') {{--ส่งไปหา destroy ด้วย id ใช้ method delete--}}
        @csrf
        <button type="submit" class="btn btn-danger">
            Delete All
        </button>
    </form>



@endsection
