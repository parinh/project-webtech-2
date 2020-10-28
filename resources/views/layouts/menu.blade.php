<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a> {{--ใช้ function url() ส่งstring ไปว่าจะไปหน้านี้--}}
            </li>
            <li class="nav-item {{ \Route::currentRouteName() === 'pages.index' ? 'active' : '' }}">{{--ดูว่าชื่อ rounte ตอนนี้ เป็น index ที่ตั้งไว้อะ หรือไม่ ถ้าใช่ จะใช้ class active--}}
                <a class="nav-link" href="{{ route('pages.index') }}">Link</a> {{--วิธีเรียก link อีกแบบนึง ต้องไปตั้งชื่อที่ route.web ก่อนนะ ใช้อันนี้ดีกว่า--}}
            </li>
            <li class="nav-item {{ \Route::currentRouteName() === 'pages.show' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pages.show',['id' => 1234]) }}">หน้า show.blade ไว้อ่าน</a> {{--ส่งแบบ ส่งค่าตามไปด้วย อาจจะเอาค่าที่ส่งไปใช้ต่อ--}}
            </li>
            <li class="nav-item {{ \Route::currentRouteName() === 'posts.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">รายการโพสทั้งหมด</a> {{--ส่งแบบ ส่งค่าตามไปด้วย อาจจะเอาค่าที่ส่งไปใช้ต่อ--}}
            </li>

        </ul>

        <ul class="navbar-nav">
            @auth() {{--ไว้ตรวจว่า login เข้ามายัง--}}
            <li class="nav-item" >
                <a href="{{ route('profile.show') }}" class="nav-link">
                    {{ Auth::user()->name }}
                </a>
            </li>
            @endauth

            @guest() {{--guest = แขก อะ--}}
                    <li class="nav-item" >
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @endguest


        </ul>

    </div>
</nav>
