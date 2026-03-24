<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::published()->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean',
        ]);

        $data = $request->all();
        $data['author'] = auth()->user()->name;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/news'), $imageName);
            $data['image'] = 'images/news/' . $imageName;
        }

        // Generate excerpt if not provided
        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($data['content']), 150);
        }

        // Set published_at if publishing
        if ($request->published) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Știrea a fost adăugată cu succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/news'), $imageName);
            $data['image'] = 'images/news/' . $imageName;
        }

        // Generate excerpt if not provided
        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($data['content']), 150);
        }

        // Set published_at if publishing for the first time
        if ($request->published && !$news->published) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Știrea a fost actualizată cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete image file
        if ($news->image && file_exists(public_path($news->image))) {
            unlink(public_path($news->image));
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Știrea a fost ștearsă cu succes!');
    }
}
