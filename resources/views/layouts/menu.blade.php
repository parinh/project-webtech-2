<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="https://ci5.googleusercontent.com/proxy/hF63XQVvMm64OX7Sku6E6BEBzw7og6BAShsBJfWnF45nWGUge1HsCIrWUJxdYJHFm-YHLrd9bhk3mfiNHSqOmVcQc0lsyhqca_qArNWXBrZ6iLlOLZbu__kZY5OzECJsSEOBdvOrWuJ0Kl8eZgB4imC8IxpeOdb6=s0-d-e1-ft#https://www.freelogodesign.org/file/app/client/thumb/ef389ec0-1132-45b7-9dcc-98908facbe36_200x200.png" width="50" height="50" alt="">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a> {{--ใช้ function url() ส่งstring ไปว่าจะไปหน้านี้--}}
            </li>

            <li class="nav-item {{ \Route::currentRouteName() === 'posts.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">Subjects List</a> {{--ส่งแบบ ส่งค่าตามไปด้วย อาจจะเอาค่าที่ส่งไปใช้ต่อ--}}
            </li>
            @auth()
            <li class="nav-item {{ \Route::currentRouteName() === 'posts.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.create') }}">Create new post</a> {{--ส่งแบบ ส่งค่าตามไปด้วย อาจจะเอาค่าที่ส่งไปใช้ต่อ--}}
            </li>
            @endauth
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
