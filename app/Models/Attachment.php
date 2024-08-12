<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageStore;

class Attachment extends Model
{
    use HasFactory, Searchable;

    public $timestamps = false;

    const UPLOAD_DIR = 'media/';
    protected $searchFields = ['id', 'name', 'alt', 'path', 'format'];
    const IMAGE_FORMATS = ['jpeg', 'png', 'jpg', 'webp'];

    protected $appends = ['urls', 'is_image'];
    protected $guarded = [];

    public function getUrlsAttribute(): array
    {
        $disk = Storage::disk('public');
        $path = self::UPLOAD_DIR . ltrim($this->path, '/');
        $pathWithExtension = $path . '.webp';
        $urls["original"] = $disk->url($pathWithExtension);

        foreach (config('image.sizes') as $sizeName => $size) {
            $urls[$sizeName] = $disk->url(in_array($this->format, self::IMAGE_FORMATS) ? $path . '_' . $size['width'] . 'x' . $size['height'] . '.' . 'webp' : $pathWithExtension);
        }

        return $urls;
    }

    public function destroyFiles(): void
    {
        $disk = Storage::disk('public');
        $path = self::UPLOAD_DIR . ltrim($this->path, '/');
        $pathWithExtension = $path . '.' . $this->format;
        $deletePaths = [$pathWithExtension];
        foreach (config('image.sizes') as $size) {
            if (in_array($this->format, self::IMAGE_FORMATS)) {
                $deletePaths[] = $path . '_' . $size['width'] . 'x' . $size['height'] . '.' . 'webp';
            }
        }

        $disk->delete($deletePaths);
    }

    public function getIsImageAttribute(): bool
    {
        return self::isImage($this->format);
    }

    static function isImage($format): bool
    {
        if (!is_string($format)) {
            return false;
        }

        if (strpos($format, '.') !== false) {
            $format = pathinfo($format, PATHINFO_EXTENSION);
        }

        return in_array($format, self::IMAGE_FORMATS);
    }

    public static function toWebp($fileName, $format)
    {

        switch ($format) {
            case 'jpeg':
            case 'jpg': {
                    $image = imagecreatefromjpeg($fileName);
                    break;
                }
            case 'png': {
                    $image = imagecreatefrompng($fileName);
                    break;
                }
        }

        $w = imagesx($image);
        $h = imagesy($image);

        $im = imagecreatetruecolor($w, $h);
        imageAlphaBlending($im, false);
        imageSaveAlpha($im, true);

        $trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefilledrectangle($im, 0, 0, $w - 1, $h - 1, $trans);

        imagecopy($im, $image, 0, 0, 0, 0, $w, $h);

        ob_start();
        imagewebp($im);
        $image = ob_get_contents();
        ob_end_clean();

        return $image;
    }

    public static function upload($file, $path = null, $format = null)
    {
        try {
            $disk = Storage::disk('public');

            if (!$format) {
                $format = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            }

            if ($path) {
                $uploadPath = trim($path, '/');
                $uploadFileName = array_reverse(explode('/', $uploadPath))[0];
            } else {
                $fileName = str_replace('|{U}|', '', pathinfo('|{U}|' . $file->getClientOriginalName(), PATHINFO_FILENAME));
                $now = Carbon::now();
                $uploadFileName = $fileName;
                $uploadPath = $now->year . '/' . ($now->month < 10 ? '0' : '') . $now->month . '/' . $fileName;
            }
            $format = trim(strtolower($format));
            $fullPath = self::UPLOAD_DIR . $uploadPath . '.' . $format;

            if (!self::isImage($format)) {
                $disk->put($fullPath, $file->getContent());

                return [
                    'path' => $uploadPath,
                    'name' => $uploadFileName,
                    'format' => $format,
                    'size' => $file->getSize(),
                ];
            }

            $attachment = ImageStore::make($file);
            $width = $attachment->width();
            $height = $attachment->height();
            $fileSize = $attachment->filesize();

            $attachment->backup();
            $disk->put($fullPath, $attachment->encode()->__toString());

            if (in_array($format, self::IMAGE_FORMATS)) {
                $imageWebp = self::toWebp(public_path('storage/' . $fullPath), $format);
                $disk->put(self::UPLOAD_DIR . $uploadPath . '.' . 'webp', $imageWebp);
            }

            foreach (config('image.sizes') as $size) {
                if (in_array($format, self::IMAGE_FORMATS)) {
                    $attachment->resize($size['width'], $size['height']);
                    $fileName = self::UPLOAD_DIR . $uploadPath . '_' . $size['width'] . 'x' . $size['height'];
                    $disk->put($fileName . '.' . $format, $attachment->encode()->__toString());

                    $imageWebp = self::toWebp(public_path('storage/' . $fileName . '.' . $format), $format);
                    $disk->put($fileName . '.' . 'webp', $imageWebp);
                    $disk->delete($fileName . '.' . $format);

                    $attachment->reset();
                }
            }

            return [
                'path' => $uploadPath,
                'name' => $uploadFileName,
                'format' => $format,
                'width' => $width,
                'height' => $height,
                'size' => $fileSize,
            ];
        } catch (\Exception $exception) {
            report($exception);
        }
        return null;
    }
}
