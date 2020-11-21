<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\isNull;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //แสดงข้แมูลหลายๆตัวออกมา
    {
        $posts = Post::paginate(5); //สร้างตัวแปรใส่ค่าของข้อมูลใน db 1 หน้าต่อ 10 ข้อมูล
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
        $attachment=Attachment::class;
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

        $uploaded_file = $request->file('uploaded_file');

        if (is_null($uploaded_file)){}
            //do not thing
        else{
            $attachment = new Attachment();
            $attachment->post_id = $post->id;
            $attachment->file_type = $uploaded_file->getClientMimeType();
            $attachment->name = $uploaded_file->getClientOriginalName();
            $attachment->file_name = $attachment->post_id . '-' . time() . '.' . $uploaded_file->getClientOriginalExtension();
            if ($attachment->file_type === 'application/pdf') {
                $attachment->asset_path = 'storage-pdf';
                $disk = 'pdf';
            } else {
                $attachment->asset_path = 'storage-images';
                $disk = 'images';
            }
            $path = $uploaded_file->storeAs('', $attachment->file_name, $disk);
            $attachment->save();
        }

        return redirect()->route('posts.index');
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

        $attachments = $post->attachments;
        $comments = $post->comments;

        return view('posts.show', [
            'post' => $post,
            'attachments' => $attachments,
            'comments' => $comments
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

        $attachments = $post->attachments;

        return view('posts.edit',[
            'post' => $post,
            'attachments' => $attachments
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
        $attachment = Attachment::where('post_id',$id);
        $attachment->delete();
        return redirect()->route('posts.index');
    }

    public function attachmentUpdate(Request $request,$id)
    {
        $uploaded_file = $request->file('uploaded_file');
        $attachment = new Attachment();

        $attachment->post_id = $id;
        $attachment->file_type = $uploaded_file->getClientMimeType();
        $attachment->name = $uploaded_file->getClientOriginalName();
        $attachment->file_name = $attachment->post_id . '-' . time() . '.' . $uploaded_file->getClientOriginalExtension();
        if ($attachment->file_type === 'application/pdf') {
            $attachment->asset_path = 'storage-pdf';
            $disk = 'pdf';
        } else {
            $attachment->asset_path = 'storage-images';
            $disk = 'images';
        }
        $path = $uploaded_file->storeAs('', $attachment->file_name, $disk);
        $attachment->save();

        return redirect()->route('posts.show',['post' => $id]);
    }

    public function createComment(Request $request,$id){

        $comment = new Comment();

        $comment->post_id = $id;
        $comment->commentname = $request->input('commentname');
        $comment->sentence = $request->input('sentence');

        $comment->save();

        return redirect()->route('posts.show',['post' => $id]);





    }


}
