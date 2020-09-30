<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a> {{--ใช้ function url() ส่งstring ไปว่าจะไปหน้านี้--}}
            </li>

            <li class="nav-item  {{ \Route::currentRouteName() === 'pages.about' ? 'active' : '' }}">{{--ดูว่าชื่อ rounte ตอนนี้ เป็น index ที่ตั้งไว้อะ หรือไม่ ถ้าใช่ จะใช้ class active--}}
                <a class="nav-link" href="{{ route('pages.about') }}">About</a> {{--วิธีเรียก link อีกแบบนึง ต้องไปตั้งชื่อที่ route.web ก่อนนะ ใช้อันนี้ดีกว่า--}}
            </li>

        </ul>

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
