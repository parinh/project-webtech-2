@extends('layouts.main')

@section('content')

    <h1>รายการไฟล์</h1>
    <a href="{{ route('attachments.create') }}">ทดสอบอัพโหลดไฟล์</a>

    {{$attachments->links()}}

    <table class="table">
        <thead>
        <tr>
            <th>Type</th>
            <th>Path</th>
            <th>Name</th>
            <th>File Name</th>
            <th>Preview</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attachments as $attachment)
            <tr>
                <td>{{ $attachment->file_type }}</td>

                <td>{{ $attachment->asset_path }}</td>

                <td>{{ $attachment->name }}</td>

                <td>{{ $attachment->file_name }}</td>


                <td>
                    <a href="{{route('attachments.show',['attachment' => $attachment->id ]) }}">
                        @if (in_array($attachment->file_type, ['image/jpeg', 'image/png']))
                            <img src="{{ asset("{$attachment->asset_path}/{$attachment->file_name}") }}" alt="" width="40">
                        @else
                            preview
                        @endif
                    </a>
                </td>
            </tr>


        @endforeach
        </tbody>
    </table>
@endsection
