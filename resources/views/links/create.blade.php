@extends('layouts.app')

@section('content')
    <h1>Create New Link</h1>

    <form action="{{ route('links.store') }}" method="POST">
        @csrf
        <div>
            <label for="original_url">Original URL:</label>
            <input type="text" id="original_url" name="original_url" required>
        </div>

        <div>
            <label for="custom_domain">Custom Domain (Optional):</label>
            <input type="text" id="custom_domain" name="custom_domain">
        </div>

        <button type="submit">Create Link</button>
    </form>
@endsection
