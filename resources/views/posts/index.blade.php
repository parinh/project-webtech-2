@extends('layouts.main')

@section('content')

    <h1>รายการโพสทั้งหมด</h1>

    @if(Auth::check())
        <p>Hello{{Auth::user()->name}}</p>
    @endif

    @can('create',\App\Models\Post::class) {{--เช็คตามเงื่นไขของ policy ใน provider ไปดู--}}
        <a href="{{ route('posts.create') }}">สร้างโพสใหม่</a>
    @endcan

    {{$posts->links()}} {{--ทำให้มันเปลี่ยนเลขหน้าได้ ไปแก้ที่ AppservicesProvider ด้วย--}}

    @foreach($posts as $post) {{--loop ที่ให้ค่าเข้ามาวน ตัวเดียววนในตัวเยอะ--}}

    <div class="card mb-3" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $post->topic }}</h5> {{--เอามาบางค่า--}}
            <p class="card-text">{{ $post->created_at }}</p>
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Go to post</a>
            {{--ลิ้งไปหาหน้า post.show แล้วก็อย่าลืมไปดูใน comman Route:List ว่า post.show ต้องการค่าอะไร แล้วก็ใส่มาด้วย อันนี้นคือให้ไปตามไอดีของโพสนั้น--}}
        </div>
    </div>
    @endforeach

@endsection
