<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Academic;
use App\Models\Contact;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::published()->count(),
            'total_gallery' => Gallery::count(),
            'featured_gallery' => Gallery::featured()->count(),
            'total_academics' => Academic::count(),
            'active_academics' => Academic::active()->count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::unread()->count(),
            'total_admins' => User::admins()->count(),
            'active_admins' => User::admins()->active()->count(),
        ];

        $recent_news = News::latest()->take(5)->get();
        $recent_contacts = Contact::latest()->take(5)->get();
        $recent_gallery = Gallery::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recent_news', 'recent_contacts', 'recent_gallery'));
    }
}
