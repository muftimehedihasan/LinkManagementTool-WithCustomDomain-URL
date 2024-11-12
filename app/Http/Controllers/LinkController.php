<?php

// app/Http/Controllers/LinkController.php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{

    public function index()
    {
        $links = Link::where('user_id', Auth::id())->get();
        return view('links.index', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
            'custom_domain' => 'nullable|url|unique:links,custom_domain',
        ]);

        $shortened_url = Str::random(6);

        // Store the link
        Link::create([
            'user_id' => Auth::id(),
            'original_url' => $request->original_url,
            'shortened_url' => $shortened_url,
            'custom_domain' => $request->custom_domain,
        ]);

        return redirect()->route('links.index')->with('success', 'Link shortened successfully!');
    }

    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        $request->validate([
            'custom_domain' => 'nullable|url|unique:links,custom_domain,' . $link->id,
        ]);

        $link->update([
            'custom_domain' => $request->custom_domain,
        ]);

        return redirect()->route('links.index')->with('success', 'Link updated successfully!');
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted successfully!');
    }

    public function redirect($shortened_url)
    {
        $link = Link::where('shortened_url', $shortened_url)->first();

        if ($link) {
            if ($link->custom_domain) {
                return redirect()->to($link->custom_domain);
            }
            return redirect()->to($link->original_url);
        }

        return redirect()->route('links.index')->withErrors('Link not found.');
    }
}
