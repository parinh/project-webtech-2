<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //แสดงข้แมูลหลายๆตัวออกมา
    {
        $posts = Post::paginate(10); //สร้างตัวแปรใส่ค่าของข้อมูลใน db 1 หน้าต่อ 10 ข้อมูล
        return view('posts.index',[
            'posts' => $posts
        ]); //ให้ไปหาไฟล์ posts/index แล้วก็ส่งค่าที่เป็น array ของ post ใน db ไปด้วย
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //สร้างอันใหม่
    {
        $this->authorize('create',Post::class); //การเอา policy มาใช้

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Post::class);
        $request->validate([ //การส้รางกฎของ laravel บอกตามเงื่อนไข
            'topic' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:500'
        ]);
        $post = new Post;
        $post->topic = $request->input('topic');
        $post->content = $request->input('content');
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect()->route('posts.index');
        //นำค่าใหม่มาใส่ใน store แล้วก็พแเสร็จก็ไปเปิดหน้า index
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //แสดงข้อมูลตามที่กำหนด $post = \App\Models\post::find(1) ไว้หาใน tinker มีอีกอันคือ ::findOrFail(100) เวลาหาไม่เจอแล้วจะออกเลย
    { //คือเวลาใส่ id ในพาทไปมันจะพาไปข้อมูลมูลตามไอดีนั้นอะ
        $post = Post::findOrFail($id); //ถ้าหาไม่เจอให้ notfound เลย ไม่ null
        $post->view_count++;//เพิ่มค่า view count 1
        $post->save();
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::findOrFail($id); //ให้มันหา id ของ post นั้น
        $this->authorize('update',$post); //ทำตาม policy ไปดู

        return view('posts.edit',[
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this
            ->$this->authorize('update',$post);
        $request->validate([ //การส้รางกฎของ laravel บอกตามเงื่อนไข
            'topic' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:500'
        ]);

        $post->topic = $request->input('topic');
        $post->content = $request->input('content');
        $post->save(); //อัพเดทค่า
        return redirect()->route('posts.show',['post' => $post->id]); //อัพเดทเสร็จแล้วก็ให้ไปหน้า show ของ id นั้น
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //ลบข้อมูล
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
