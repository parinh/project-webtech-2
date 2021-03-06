@extends('layouts.main')

@section('content')

    <h1>หน้าแสดงเพจ</h1>
    <h2>อ่านเพิ่มเติมที่ laravel/blade</h2>

    @if ($id > 100) {{--การใช่ if else--}}
    <h3>{{$id}} > 100 </h3> {{--ใส่ html ได้เลย--}}
    @endif

    @unless ($id > 100) {{--ถ้าไม่ แต่จริงใช้ให้ออกนอก if ก็ได้เหมือนกัน--}}
        <h3>{{ $id }} <= 100</h3>
    @endunless

    @isset ($records) {{--ถ้ามีและ ไม่ null ไม่ค่อยได้ใช้--}}
        <p>มีตัวแปร $records ที่ไม่เป็น null</p>
    @endisset

    @empty($array) {{--ถ้ามีตัวแปรนั้นแต่ว่า ว่างอยู ใช้บ่อย--}}
        <p>มีตัวแปร array แต่เป็น array ว่าง หรือ null</p>
    @endempty




    {{ $text }} {{--ไม่ประมวลผล html ควรใช้แบบนี้--}}

    {!! $text !!} {{--ประมวลผล html มันทำให้เกิดช่องโหว่--}}

    @{{ $text }} {{--สามารถใส่ @ ข้างหน้าเพื่อให้มัน แสดงผลเป็น text--}}}

    <p>Name: {{$name}}</p>
    <p>ID: {{$id}}</p> {{--นำค่าที่ได้มาจาก route มาแสดงค่า ไปดูหน้า web.php--}}

    <p>Time: {{ time() }}</p>  {{--function เรียกมาใช้ได้เลย--}}

    <p>Time: {{ date('Y-m-d H:i:s') }}</p> {{--ใช้วันที่ได้ แต่อย่าลืมเปลี่ยนที่ app เป็นไทยก่อนนะ--}}


    @endsection
