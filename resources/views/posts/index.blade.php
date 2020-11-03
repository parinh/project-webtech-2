@extends('layouts.main')

@section('content')

{{--    <h1>All Posts</h1>--}}

    @if(Auth::check())
        <div class="jumbotron bg-info text-white">
            <h1 style="text-align: center">Welcome {{Auth::user()->name}}</h1>
        </div>

    @endif

    @can('create',\App\Models\Post::class) {{--เช็คตามเงื่นไขของ policy ใน provider ไปดู--}}
    <button class="btn btn-success mb-3 justify-content-center">
        <a style="color: white" href="{{ route('posts.create') }}">Create new post</a>
    </button>

    @endcan



    @foreach($posts as $post) {{--loop ที่ให้ค่าเข้ามาวน ตัวเดียววนในตัวเยอะ--}}
    <div class="row">
        <div class="card mb-3 col-sm bg-dark text-white" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $post->topic }}</h5> {{--เอามาบางค่า--}}
                <p class="card-text">{{ $post->created_at }}</p>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-outline-warning">Go to post</a>
                {{--ลิ้งไปหาหน้า post.show แล้วก็อย่าลืมไปดูใน comman Route:List ว่า post.show ต้องการค่าอะไร แล้วก็ใส่มาด้วย อันนี้นคือให้ไปตามไอดีของโพสนั้น--}}
            </div>
        </div>
    </div>
    @endforeach
{{$posts->links()}} {{--ทำให้มันเปลี่ยนเลขหน้าได้ ไปแก้ที่ AppservicesProvider ด้วย--}}

@endsection
