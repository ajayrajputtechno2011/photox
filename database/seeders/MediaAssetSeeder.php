<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\MediaAsset;
use Illuminate\Database\Seeder;

class MediaAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = Banner::all();
        foreach ($banners as $b) {
            if (! empty($b->image_url)) {
                $path = $b->image_url;
                $name = basename($path);
                $fullDiskPath = public_path(ltrim($path, '/'));
                $size = file_exists($fullDiskPath) ? filesize($fullDiskPath) : 150000;
                $dims = null;
                if (file_exists($fullDiskPath) && @getimagesize($fullDiskPath)) {
                    $info = getimagesize($fullDiskPath);
                    $dims = $info[0].'x'.$info[1];
                }
                MediaAsset::firstOrCreate(
                    ['file_path' => $path],
                    [
                        'filename' => $name,
                        'original_name' => $b->title ?: $name,
                        'disk' => 'public',
                        'mime_type' => 'image/jpeg',
                        'file_size' => $size,
                        'dimensions' => $dims,
                        'title' => $b->title ?: 'Banner Asset',
                        'folder' => 'banners',
                    ]
                );
            }
        }
    }
}
