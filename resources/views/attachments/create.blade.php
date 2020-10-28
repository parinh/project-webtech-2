@extends('layouts.main')

@section('content')
    <h1>[TEST] Upload File</h1>

    @if ($errors->any()) {{--เงื่อนไขที่ตั้งไว้หน้า postscon ถ้าผิดจะเกิด error--}}
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('attachments.store') }}" method="POST" enctype="multipart/form-data"> {{--ให้มันไปหา post.store--}}
        @csrf {{--สร้าง token พิเศษป้องกันข้อมูล มันจะสร้าง token แต่ละคนไม่เหมือนกันและมีเวลาจำกัดจาก server จะได้ส่งข้อมูลไปหาระบบได้ถูกระบบ--}}

        <p>Select image to upload:</p>
        <input type="file" name="uploaded_file" id="file">
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>


@endsection
