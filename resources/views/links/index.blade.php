@extends('layouts.app')

@section('content')
    <h1>Your Links</h1>

    <a href="{{ route('links.create') }}">Create New Link</a>

    <table>
        <thead>
            <tr>
                <th>Original URL</th>
                <th>Shortened URL</th>
                <th>Custom Domain</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->original_url }}</td>
                    <td>{{ url($link->shortened_url) }}</td>
                    <td>{{ $link->custom_domain ?? 'None' }}</td>
                    <td>
                        <a href="{{ route('links.edit', $link) }}">Edit</a>
                        <form action="{{ route('links.destroy', $link) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
