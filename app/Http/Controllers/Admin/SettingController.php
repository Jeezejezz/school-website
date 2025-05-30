<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function header()
    {
        $headerSettings = Setting::byGroup('header')->get();
        return view('admin.settings.header', compact('headerSettings'));
    }

    public function footer()
    {
        $footerSettings = Setting::byGroup('footer')->get();
        return view('admin.settings.footer', compact('footerSettings'));
    }

    public function updateHeader(Request $request)
    {
        $request->validate([
            'header_title' => 'required|string|max:255',
            'header_tagline' => 'nullable|string|max:500',
            'header_phone' => 'nullable|string|max:20',
            'header_email' => 'nullable|email|max:255',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Update text settings
        $textSettings = ['header_title', 'header_tagline', 'header_phone', 'header_email'];
        foreach ($textSettings as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // Handle logo upload
        if ($request->hasFile('header_logo')) {
            // Delete old logo
            $oldLogo = Setting::get('header_logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Upload new logo
            $logoPath = $request->file('header_logo')->store('settings', 'public');
            Setting::set('header_logo', $logoPath);
        }

        return redirect()->route('admin.settings.header')->with('success', 'Pengaturan header berhasil diperbarui!');
    }

    public function updateFooter(Request $request)
    {
        $request->validate([
            'footer_about' => 'nullable|string|max:1000',
            'footer_address' => 'nullable|string|max:500',
            'footer_phone' => 'nullable|string|max:20',
            'footer_email' => 'nullable|email|max:255',
            'footer_copyright' => 'nullable|string|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255'
        ]);

        $footerSettings = [
            'footer_about', 'footer_address', 'footer_phone', 'footer_email',
            'footer_copyright', 'social_facebook', 'social_instagram',
            'social_youtube', 'social_twitter'
        ];

        foreach ($footerSettings as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        return redirect()->route('admin.settings.footer')->with('success', 'Pengaturan footer berhasil diperbarui!');
    }
}
