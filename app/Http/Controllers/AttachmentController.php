<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Models\Post;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attachments = Attachment::paginate(5);
        return view('Attachments.index',[
            'attachments' => $attachments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('attachments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $uploaded_file = $request->file('uploaded_file');
//        // ต้องทำ validate ก่อน
//
//        $attachment = new Attachment();
//        $attachment->post_id = 1;
//        $attachment->file_type = $uploaded_file->getClientMimeType();
//        $attachment->name = $uploaded_file->getClientOriginalName();
//        $attachment->file_name = $attachment->post_id . '-' . time() . '.' . $uploaded_file->getClientOriginalExtension();
//        if ($attachment->file_type === 'application/pdf') {
//            $attachment->asset_path = 'storage-pdf';
//            $disk = 'pdf';
//        } else {
//            $attachment->asset_path = 'storage-images';
//            $disk = 'images';
//        }
//        $path = $uploaded_file->storeAs('', $attachment->file_name, $disk);
//        $attachment->save();
//
//        return redirect()->route('attachments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->save();
        return view('attachments.show',[
            'attachment' => $attachment
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        $post_id = $attachment->post_id;
        $attachment->delete();


        return redirect()->route('posts.show',['post' => $post_id]);
    }
}
