<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Homepage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_image_path',
        'hero_button_text',
        'hero_button_link',
        'welcome_title',
        'welcome_description',
        'welcome_image_path',
        'welcome_video_type',
        'welcome_video_path',
        'welcome_video_link',
        'welcome_video_thumbnail',
        'welcome_video_position',
        'stats_students',
        'stats_teachers',
        'stats_programs',
        'stats_achievements',
        'show_news_section',
        'show_gallery_section',
        'show_testimonials_section',
        'show_contact_section'
    ];

    protected $casts = [
        'show_news_section' => 'boolean',
        'show_gallery_section' => 'boolean',
        'show_testimonials_section' => 'boolean',
        'show_contact_section' => 'boolean'
    ];

    /**
     * Get the first homepage record or create default
     */
    public static function getSettings()
    {
        return self::first() ?: self::create([
            'hero_title' => 'Selamat Datang di Sekolah Kami',
            'hero_subtitle' => 'Membangun generasi unggul dengan pendidikan berkualitas dan karakter yang kuat untuk masa depan yang gemilang.',
            'welcome_title' => 'Selamat Datang di Sekolah Kami',
            'welcome_description' => 'Kami berkomitmen memberikan pendidikan terbaik dengan fasilitas modern dan tenaga pengajar yang berpengalaman.',
            'stats_students' => '1000+',
            'stats_teachers' => '50+',
            'stats_programs' => '10+',
            'stats_achievements' => '100+',
            'welcome_video_type' => 'none',
            'welcome_video_position' => 'below'
        ]);
    }

    /**
     * Get YouTube video ID from URL
     */
    public function getYouTubeVideoId()
    {
        if ($this->welcome_video_type !== 'link' || !$this->welcome_video_link) {
            return null;
        }

        $url = $this->welcome_video_link;

        // Handle different YouTube URL formats
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Get Vimeo video ID from URL
     */
    public function getVimeoVideoId()
    {
        if ($this->welcome_video_type !== 'link' || !$this->welcome_video_link) {
            return null;
        }

        $url = $this->welcome_video_link;

        // Handle Vimeo URL formats
        if (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/', $url, $matches)) {
            return $matches[3];
        }

        return null;
    }

    /**
     * Check if video is YouTube
     */
    public function isYouTubeVideo()
    {
        return $this->getYouTubeVideoId() !== null;
    }

    /**
     * Check if video is Vimeo
     */
    public function isVimeoVideo()
    {
        return $this->getVimeoVideoId() !== null;
    }

    /**
     * Get video embed URL
     */
    public function getVideoEmbedUrl()
    {
        if ($this->welcome_video_type !== 'link') {
            return null;
        }

        if ($youtubeId = $this->getYouTubeVideoId()) {
            return "https://www.youtube.com/embed/{$youtubeId}?rel=0&showinfo=0";
        }

        if ($vimeoId = $this->getVimeoVideoId()) {
            return "https://player.vimeo.com/video/{$vimeoId}";
        }

        return null;
    }
}
