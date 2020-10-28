<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class PagesController extends Controller
{
    public function index() { //action index
        return view('pages.index');
    }

    public function show ($id){ //action show
        $attachments[0] = Attachment::find(1);
        $attachments[1] = Attachment::find(2);
        return view('pages.show',[ //ใส่ค่าไว้เพื่อส่งไปหน้าแสดงผล ไปดุหน้า show
            'name' => 'Samantha', //set ค่าไว้เพื่อนำไปเรียกใช้
            'id' => $id,
            'text' => '<h3> H3 text </h3>',
            'array' => [],
            'attachments' => $attachments
        ]);
    }

    public function test_file() {
        $fileContents = 'hopper';
        Storage::disk('public')->put('parin.text', $fileContents);
        return redirect('/pages/1234');
    }

}
