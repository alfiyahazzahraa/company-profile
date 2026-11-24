<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->latest()->paginate(10);

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'required|image|max:4096',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        $validated['image'] = $request->file('image')
            ->store('sliders', 'public');

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);

            $validated['image'] = $request->file('image')
                ->store('sliders', 'public');
        }

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider berhasil dihapus.');
    }
}