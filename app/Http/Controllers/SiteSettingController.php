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

        /*
        |--------------------------------------------------------------------------
        | Upload Site Logo
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('site_logo')) {

            $logo = $request->file('site_logo');

            // Generate unique filename
            $logoName = time() . '_logo_' . uniqid('', true) . '.' . $logo->getClientOriginalExtension();

            // root/uploads/site_settings
            $logoPath = base_path('uploads/site_settings');

            // Create folder if not exists
            if (!file_exists($logoPath)) {

                if (!mkdir($logoPath, 0755, true) && !is_dir($logoPath)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $logoPath));
                }
            }

            // Move uploaded file
            $logo->move($logoPath, $logoName);

            // Save path in database
            SiteSetting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => 'uploads/site_settings/' . $logoName]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Site Favicon
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('site_favicon')) {

            $favicon = $request->file('site_favicon');

            // Generate unique filename
            $faviconName = time() . '_favicon_' . uniqid('', true) . '.' . $favicon->getClientOriginalExtension();

            // root/uploads/site_settings
            $faviconPath = base_path('uploads/site_settings');

            // Create folder if not exists
            if (!file_exists($faviconPath)) {

                if (!mkdir($faviconPath, 0755, true) && !is_dir($faviconPath)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $faviconPath));
                }
            }

            // Move uploaded file
            $favicon->move($faviconPath, $faviconName);

            // Save path in database
            SiteSetting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => 'uploads/site_settings/' . $faviconName]
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
