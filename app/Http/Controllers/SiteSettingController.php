<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key')->all();
        return view('admin.site_settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'site_logo', 'site_favicon']);
        
        // Handle Site Logo Upload
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('site_settings', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => 'storage/' . $logoPath]
            );
        }

        // Handle Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('site_settings', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => 'storage/' . $faviconPath]
            );
        }

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        toast('Site settings updated successfully.', 'success');

        return redirect()->back();
    }
}
