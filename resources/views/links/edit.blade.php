@extends('layouts.app')

@section('content')
    <h1>Edit Link</h1>

    <form action="{{ route('links.update', $link) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label for="custom_domain">Custom Domain (Optional):</label>
            <input type="text" id="custom_domain" name="custom_domain" value="{{ $link->custom_domain }}">
        </div>

        <button type="submit">Update Link</button>
    </form>
@endsection
