<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('sort_order')
            ->latest()->paginate(10);

        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('team', 'public');
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('team', 'public');
        }

        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }

        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil dihapus.');
    }
}