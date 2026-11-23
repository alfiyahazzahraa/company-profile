<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::first() ?? new Setting();

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        $setting->fill($data);
        $setting->save();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Pengaturan website berhasil disimpan.');
    }
}