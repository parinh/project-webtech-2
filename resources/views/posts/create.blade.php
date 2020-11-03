@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <h1 style="color: white">Create new posts</h1>
    </div>
    <hr>


    @if ($errors->any()) {{--เงื่อนไขที่ตั้งไว้หน้า postscon ถ้าผิดจะเกิด error--}}
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"> {{--ให้มันไปหา post.store--}}
        @csrf {{--สร้าง token พิเศษป้องกันข้อมูล มันจะสร้าง token แต่ละคนไม่เหมือนกันและมีเวลาจำกัดจาก server จะได้ส่งข้อมูลไปหาระบบได้ถูกระบบ--}}

        <div class="form-group">
            <label for="topic">Subject Name</label>
            <input style="width: 500px" type="text" class="form-control" @error('topic') is-invalid @enderror id="topic" {{--id ต้องชื่อเหมือนกันใน loop for each  --}}
                name="topic" {{--สร้างชื่อให้ตัวแปร--}}
                value="{{ old('topic') }}" {{--เวลา error แล้วตัวหนังสือไม่หานน--}}
                   aria-describedby="topicHelpqt text-muted">
                Subject Name is required
            </small>
            @error('topic') {{--การทำให้ช่องขึ้นแดงเวลาเกิด error ที่ช่องนั้น--}}
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group" style="width: 500px">
            <label for="content">Detail</label>
            <textarea style="height: 200px" class="form-control" @error('content') is-invalid @enderror name="content" id="content" {{old('content')}}></textarea>

            @error('topic') {{--การทำให้ช่องขึ้นแดงเวลาเกิด error--}}
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <p>Select file to upload:</p>
            <input  type="file" name="uploaded_file" id="file">


        <button type="submit" class="btn btn-primary">Create</button>
    </form>


@endsection
<script>
    import Input from "../../js/Jetstream/Input";
    export default {
        components: {Input}
    }
</script>
