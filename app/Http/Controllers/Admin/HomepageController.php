<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homepage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    /**
     * Show homepage settings
     */
    public function index()
    {
        $homepage = Homepage::getSettings();
        return view('admin.homepage.index', compact('homepage'));
    }

    /**
     * Show edit form
     */
    public function edit()
    {
        $homepage = Homepage::getSettings();
        return view('admin.homepage.edit', compact('homepage'));
    }

    /**
     * Update homepage settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string',
            'hero_button_text' => 'required|string|max:100',
            'hero_button_link' => 'required|string|max:255',
            // 'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Disabled - using hero images slider

            'welcome_title' => 'required|string|max:255',
            'welcome_description' => 'required|string',
            'welcome_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'welcome_video_type' => 'required|in:none,upload,link',
            'welcome_video' => 'nullable|mimes:mp4,avi,mov,wmv,flv,webm|max:51200', // 50MB max
            'welcome_video_link' => 'nullable|url',
            'welcome_video_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'welcome_video_position' => 'required|in:below,side',

            'stats_students' => 'required|string|max:20',
            'stats_teachers' => 'required|string|max:20',
            'stats_programs' => 'required|string|max:20',
            'stats_achievements' => 'required|string|max:20',

            'show_news_section' => 'boolean',
            'show_gallery_section' => 'boolean',
            'show_testimonials_section' => 'boolean',
            'show_contact_section' => 'boolean'
        ]);

        $homepage = Homepage::getSettings();
        $data = $request->except(['welcome_image', 'welcome_video', 'welcome_video_thumbnail']); // Removed hero_image

        // Handle boolean checkboxes
        $data['show_news_section'] = $request->has('show_news_section');
        $data['show_gallery_section'] = $request->has('show_gallery_section');
        $data['show_testimonials_section'] = $request->has('show_testimonials_section');
        $data['show_contact_section'] = $request->has('show_contact_section');

        // Hero image upload disabled - using hero images slider instead
        // if ($request->hasFile('hero_image')) {
        //     // Delete old image
        //     if ($homepage->hero_image_path && Storage::disk('public')->exists($homepage->hero_image_path)) {
        //         Storage::disk('public')->delete($homepage->hero_image_path);
        //     }
        //
        //     $image = $request->file('hero_image');
        //     $filename = 'hero_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        //     $path = $image->storeAs('homepage', $filename, 'public');
        //     $data['hero_image_path'] = $path;
        // }

        // Handle welcome image upload
        if ($request->hasFile('welcome_image')) {
            // Delete old image
            if ($homepage->welcome_image_path && Storage::disk('public')->exists($homepage->welcome_image_path)) {
                Storage::disk('public')->delete($homepage->welcome_image_path);
            }

            $image = $request->file('welcome_image');
            $filename = 'welcome_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('homepage', $filename, 'public');
            $data['welcome_image_path'] = $path;
        }

        // Handle video based on type
        if ($data['welcome_video_type'] === 'upload' && $request->hasFile('welcome_video')) {
            // Delete old video
            if ($homepage->welcome_video_path && Storage::disk('public')->exists($homepage->welcome_video_path)) {
                Storage::disk('public')->delete($homepage->welcome_video_path);
            }

            // Delete old thumbnail
            if ($homepage->welcome_video_thumbnail && Storage::disk('public')->exists($homepage->welcome_video_thumbnail)) {
                Storage::disk('public')->delete($homepage->welcome_video_thumbnail);
            }

            $video = $request->file('welcome_video');
            $filename = 'video_' . time() . '_' . Str::random(10) . '.' . $video->getClientOriginalExtension();
            $path = $video->storeAs('homepage/videos', $filename, 'public');
            $data['welcome_video_path'] = $path;

            // Clear link data when uploading
            $data['welcome_video_link'] = null;
        } elseif ($data['welcome_video_type'] === 'link') {
            // Delete old uploaded video when switching to link
            if ($homepage->welcome_video_path && Storage::disk('public')->exists($homepage->welcome_video_path)) {
                Storage::disk('public')->delete($homepage->welcome_video_path);
            }

            $data['welcome_video_path'] = null;
        } elseif ($data['welcome_video_type'] === 'none') {
            // Delete all video data when setting to none
            if ($homepage->welcome_video_path && Storage::disk('public')->exists($homepage->welcome_video_path)) {
                Storage::disk('public')->delete($homepage->welcome_video_path);
            }
            if ($homepage->welcome_video_thumbnail && Storage::disk('public')->exists($homepage->welcome_video_thumbnail)) {
                Storage::disk('public')->delete($homepage->welcome_video_thumbnail);
            }

            $data['welcome_video_path'] = null;
            $data['welcome_video_link'] = null;
            $data['welcome_video_thumbnail'] = null;
        }

        // Handle video thumbnail upload (for uploaded videos or link videos)
        if ($request->hasFile('welcome_video_thumbnail')) {
            // Delete old thumbnail
            if ($homepage->welcome_video_thumbnail && Storage::disk('public')->exists($homepage->welcome_video_thumbnail)) {
                Storage::disk('public')->delete($homepage->welcome_video_thumbnail);
            }

            $thumbnail = $request->file('welcome_video_thumbnail');
            $filename = 'thumb_' . time() . '_' . Str::random(10) . '.' . $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->storeAs('homepage/thumbnails', $filename, 'public');
            $data['welcome_video_thumbnail'] = $path;
        }

        $homepage->update($data);

        return redirect()->route('admin.homepage.index')->with('success', 'Pengaturan beranda berhasil diperbarui!');
    }

    /**
     * Reset to default settings
     */
    public function reset()
    {
        $homepage = Homepage::getSettings();

        // Delete uploaded images
        if ($homepage->hero_image_path && Storage::disk('public')->exists($homepage->hero_image_path)) {
            Storage::disk('public')->delete($homepage->hero_image_path);
        }
        if ($homepage->welcome_image_path && Storage::disk('public')->exists($homepage->welcome_image_path)) {
            Storage::disk('public')->delete($homepage->welcome_image_path);
        }

        // Delete uploaded videos and thumbnails
        if ($homepage->welcome_video_path && Storage::disk('public')->exists($homepage->welcome_video_path)) {
            Storage::disk('public')->delete($homepage->welcome_video_path);
        }
        if ($homepage->welcome_video_thumbnail && Storage::disk('public')->exists($homepage->welcome_video_thumbnail)) {
            Storage::disk('public')->delete($homepage->welcome_video_thumbnail);
        }

        // Reset to default values
        $homepage->update([
            'hero_title' => 'Selamat Datang di Sekolah Kami',
            'hero_subtitle' => 'Membangun generasi unggul dengan pendidikan berkualitas dan karakter yang kuat untuk masa depan yang gemilang.',
            'hero_image_path' => null,
            'hero_button_text' => 'Pelajari Lebih Lanjut',
            'hero_button_link' => '#about',
            'welcome_title' => 'Selamat Datang di Sekolah Kami',
            'welcome_description' => 'Kami berkomitmen memberikan pendidikan terbaik dengan fasilitas modern dan tenaga pengajar yang berpengalaman.',
            'welcome_image_path' => null,
            'welcome_video_type' => 'none',
            'welcome_video_path' => null,
            'welcome_video_link' => null,
            'welcome_video_thumbnail' => null,
            'welcome_video_position' => 'below',
            'stats_students' => '1000+',
            'stats_teachers' => '50+',
            'stats_programs' => '10+',
            'stats_achievements' => '100+',
            'show_news_section' => true,
            'show_gallery_section' => true,
            'show_testimonials_section' => true,
            'show_contact_section' => true
        ]);

        return redirect()->route('admin.homepage.index')->with('success', 'Pengaturan beranda berhasil direset ke default!');
    }
}
