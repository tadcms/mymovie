<?php

namespace App\Models;

use App\Helpers\GoogleDrive;
use App\Helpers\VideoStream;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VideoFiles
 *
 * @property int $id
 * @property int $server_id
 * @property int $movie_id
 * @property string $label
 * @property int $order
 * @property string $source
 * @property string $url
 * @property string|null $video_240p
 * @property string|null $video_360p
 * @property string|null $video_480p
 * @property string|null $video_720p
 * @property string|null $video_1080p
 * @property string|null $video_2048p
 * @property string|null $video_4096p
 * @property int $converted
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereConverted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo1080p($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo2048p($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo240p($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo360p($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo4096p($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo480p($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VideoFiles whereVideo720p($value)
 * @mixin \Eloquent
 */
class VideoFiles extends Model
{
    protected $table = 'video_files';
    protected $primaryKey = 'id';
    protected $fillable = [
        'label',
        'order',
        'source',
        'url',
        'status',
    ];
    
    public function server() {
        $this->belongsTo('App\Models\Servers', 'server_id', 'id');
    }
    
    public function getFiles() {
        
        switch ($this->source) {
            case 'youtube';
                return $this->getVideoYoutube();
            case 'vimeo':
                return $this->getVideoVimeo();
            case 'upload':
                return $this->getVideoUpload();
            case 'gdrive':
                return $this->getVideoGoogleDrive();
            case 'mp4';
                return $this->getVideoUrl('mp4');
            case 'mkv';
                return $this->getVideoUrl('mkv');
            case 'webm':
                return $this->getVideoUrl('webm');
            case 'm3u8':
                return $this->getVideoUrl('webm');
            case 'embed':
                return $this->getVideoUrl('embed');
        }
        
        return false;
    }
    
    protected function getExtension() {
        $file_name = basename($this->url);
        return explode('.', $file_name)[count(explode('.', $file_name)) - 1];
    }
    
    protected function getVideoYoutube() {
        return [
            [
                'url' => '//www.youtube.com/watch?v=' . get_youtube_id($this->url),
                'type' => 'video/youtube',
            ]
        ];
    }
    
    protected function getVideoVimeo() {
        return [
            [
                'url' => $this->url,
                'type' => 'mp4',
            ]
        ];
    }
    
    protected function getVideoUrl($type) {
        return [
            (object) [
                'url' => $this->url,
                'type' => $type,
            ]
        ];
    }
    
    protected function getVideoUpload() {
        if ($this->converted == 1) {
            $files = [];
            if ($this->video_240p) {
                $files[] = (object) [
                    'quality' => '240p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_240p),
                ];
            }
    
            if ($this->video_360p) {
                $files[] = (object) [
                    'quality' => '360p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_360p),
                ];
            }
    
            if ($this->video_480p) {
                $files[] = (object) [
                    'quality' => '480p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_480p),
                ];
            }
    
            if ($this->video_720p) {
                $files[] = (object) [
                    'quality' => '720p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_720p),
                ];
            }
    
            if ($this->video_1080p) {
                $files[] = (object) [
                    'quality' => '1080p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_1080p),
                ];
            }
    
            if ($this->video_2048p) {
                $files[] = (object) [
                    'quality' => '2048p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_2048p),
                ];
            }
    
            if ($this->video_4096p) {
                $files[] = (object) [
                    'quality' => '4096p',
                    'type' => $this->getExtension(),
                    'url' => $this->generateStreamUrl($this->video_4096p),
                ];
            }
            
            if (count($files) > 0) {
                return $files;
            }
        }
        
        return [
            (object) [
                'url' => $this->generateStreamUrl($this->url),
                'type' => $this->getExtension(),
            ]
        ];
    }
    
    protected function getVideoGoogleDrive() {
        $gdrive = new GoogleDrive($this->url);
        return $gdrive->getLinkPlay();
    }
    
    protected function generateStreamUrl($path) {
        $token = VideoStream::generateToken(basename($path));
        $file = json_encode([
            'path' => $path,
        ]);
        
        $file = \Crypt::encryptString($file);
        
        return route('stream.video', [$token, $file, basename($path)]);
    }
}
