<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\CMS\Facades;

use Illuminate\Support\Collection;

class Facade
{
    public static function defaultConfigs(): Collection
    {
        return collect(
            [
                'title',
                'description',
                'banner',
                'logo',
                'icon',
                'banner',
                'sitename',
                'user_registration',
                'user_verification',
                'comment_able',
                'comment_type',
                'comments_per_page',
                'comments_approval',
                'author_name',
                'facebook',
                'twitter',
                'pinterest',
                'youtube',
                'google_analytics',
                'language',
                'timezone',
                'date_format',
                'time_format',
                'fb_app_id',
                'backend_messages',
                'socialites',
            ]
        );
    }

    public static function defaultImageMimetypes(): Collection
    {
        return collect(
            [
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/gif',
                'image/svg+xml',
            ]
        );
    }

    public static function defaultSVGMimetypes(): Collection
    {
        return collect(
            [
                'image/svg+xml',
            ]
        );
    }
}