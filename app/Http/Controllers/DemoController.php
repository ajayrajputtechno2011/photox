<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\PageHero;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DemoController extends Controller
{
    /**
     * Admin dummy event creation & photo upload sandbox screen.
     */
    public function adminEvent(Request $request): View
    {
        $categories = Category::where('is_active', true)->orderBy('name', 'asc')->get();
        $dummyEvents = Event::where('is_demo', true)->withCount('photos')->latest()->get();
        $selectedEvent = null;

        if ($request->filled('event_id')) {
            $selectedEvent = Event::with('photos')->find($request->input('event_id'));
        } elseif ($dummyEvents->isNotEmpty()) {
            $selectedEvent = Event::with('photos')->find($dummyEvents->first()->id);
        }

        $watermarkSetting = WatermarkSetting::firstOrCreate(
            ['user_id' => null],
            [
                'is_watermark_enabled' => true,
                'watermark_type' => 'both',
                'watermark_color' => '#ff8a00',
                'watermark_text' => 'PhotoX',
                'font_size' => 25,
                'opacity' => 65,
                'rotation' => -12,
                'is_tiled' => true,
                'watermark_pattern' => 'tile',
                'logo_path' => '/uploads/watermarks/swirl_logo.png',
                'logo_size' => 45,
                'both_layout' => 'fotto_style',
                'both_gap' => 8,
                'security_badge_text' => 'Do not screenshot',
                'has_cross_lines' => true,
                'has_security_badge' => true,
                'is_download_protection_enabled' => true,
                'is_post_purchase_enabled' => true,
                'post_purchase_mode' => 'sponsor_branding',
                'sponsor_logo_path' => '/logo.png',
                'sponsor_placement' => 'bottom-right',
                'sponsor_logo_size' => 30,
                'sponsor_opacity' => 85,
            ]
        );

        return view('demo.admin-dummy-event', compact('categories', 'dummyEvents', 'selectedEvent', 'watermarkSetting'));
    }

    /**
     * Store a new dummy event.
     */
    public function adminEventStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'starting_price' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|url',
        ]);

        $category = Category::find($validated['category_id']);
        $coverImageUrl = $validated['cover_image_url'] ?? null;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('uploads/demo/covers', 'public');
            $coverImageUrl = '/storage/'.$path;
        }

        if (empty($coverImageUrl)) {
            $coverImageUrl = 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1200&q=80';
        }

        $slug = Str::slug($validated['title']).'-demo-'.Str::random(5);

        $event = Event::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $category->id,
            'category_name' => $category->name,
            'location' => $validated['location'],
            'event_date' => $validated['event_date'],
            'starting_price' => $validated['starting_price'] ?? 'From R50',
            'total_photos' => 0,
            'photographers_count' => 1,
            'description' => $validated['description'] ?? 'Sandbox dummy event for testing watermark rendering and metadata extraction.',
            'cover_image' => $coverImageUrl,
            'is_featured' => true,
            'status' => 'published',
            'is_demo' => true,
        ]);

        return redirect()->route('admin.dummy.event', ['event_id' => $event->id])
            ->with('success', 'Dummy Event "'.$event->title.'" created successfully! Now upload sample photos below.');
    }

    /**
     * Bulk upload photos to a dummy event with automated EXIF extraction and immediate watermark generation.
     */
    public function adminUploadPhotos(Request $request)
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'personal_price' => 'nullable|numeric|min:0',
            'commercial_price' => 'nullable|numeric|min:0',
        ]);

        $event = Event::findOrFail($request->input('event_id'));
        $personalPrice = (float) $request->input('personal_price', 50.00);
        $commercialPrice = (float) $request->input('commercial_price', 250.00);

        // Ensure storage upload directories exist with full permissions
        $photosDir = storage_path('app/public/uploads/demo/photos');
        $watermarkedDir = storage_path('app/public/uploads/demo/watermarked');
        if (! is_dir($photosDir)) {
            @mkdir($photosDir, 0777, true);
        }
        if (! is_dir($watermarkedDir)) {
            @mkdir($watermarkedDir, 0777, true);
        }

        // Accept files whether passed as array or single file, checking all possible input keys
        $files = $request->file('photos');
        if (! $files) {
            $files = $request->file('photo') ?? $request->file('images') ?? $request->file('image');
        }
        if (! $files) {
            // Check allFiles if named dynamically
            $allFiles = $request->allFiles();
            if (! empty($allFiles)) {
                $first = reset($allFiles);
                $files = is_array($first) ? $first : [$first];
            }
        }
        if (! is_array($files)) {
            $files = $files ? [$files] : [];
        }

        if (empty($files)) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'No files were uploaded. Please select one or more photos.'], 422);
            }

            return back()->with('error', 'Please select one or more photos to upload.');
        }

        $uploadedCount = 0;
        $createdPhotos = [];

        foreach ($files as $file) {
            if (! $file || ! $file->isValid()) {
                $err = $file ? $file->getErrorMessage() : 'Empty file instance';
                Log::warning('Demo photo upload file invalid: '.$err);

                continue;
            }

            try {
                $originalName = $file->getClientOriginalName();
                $path = $file->store('uploads/demo/photos', 'public');
                $publicPath = '/storage/'.$path;
                $fullDiskPath = storage_path('app/public/'.$path);
                @chmod($fullDiskPath, 0777);

                $meta = $this->extractExif($fullDiskPath);

                $photo = EventPhoto::create([
                    'event_id' => $event->id,
                    'file_path' => $publicPath,
                    'original_name' => $originalName,
                    'title' => pathinfo($originalName, PATHINFO_FILENAME),
                    'camera_make' => $meta['camera_make'],
                    'camera_model' => $meta['camera_model'],
                    'lens' => $meta['lens'],
                    'focal_length' => $meta['focal_length'],
                    'shutter_speed' => $meta['shutter_speed'],
                    'aperture' => $meta['aperture'],
                    'iso' => $meta['iso'],
                    'flash' => $meta['flash'],
                    'dimensions' => $meta['dimensions'],
                    'file_size' => $meta['file_size'],
                    'captured_at' => $meta['captured_at'],
                    'photographer_name' => $meta['photographer_name'] ?? 'Demo Photographer',
                    'copyright' => $meta['copyright'] ?? '© 2026 PhotoX All Rights Reserved',
                    'personal_price' => $personalPrice,
                    'commercial_price' => $commercialPrice,
                    'is_demo' => true,
                ]);

                // Automatically generate burned-in Fotto-style watermarked preview image using GD
                $this->generateWatermarkedPreview($photo);

                $createdPhotos[] = $photo;
                $uploadedCount++;
            } catch (\Throwable $e) {
                Log::error('Upload photo processing failed: '.$e->getMessage().' in '.$e->getFile().':'.$e->getLine());
            }
        }

        $event->update([
            'total_photos' => $event->photos()->count(),
        ]);

        if ($uploadedCount === 0) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Upload failed. Selected files could not be processed. Please check file format.'], 422);
            }

            return back()->with('error', 'Upload failed. Selected files could not be processed. Please check file format.');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$uploadedCount} photo(s) uploaded and watermarked successfully!",
                'count' => $uploadedCount,
                'photos' => $createdPhotos,
            ]);
        }

        return redirect()->route('admin.dummy.event', ['event_id' => $event->id])
            ->with('success', "{$uploadedCount} photo(s) uploaded, watermarks generated, and EXIF metadata extracted successfully!");
    }

    /**
     * Delete a dummy photo.
     */
    public function adminDeletePhoto(Request $request, int $id)
    {
        $photo = EventPhoto::findOrFail($id);
        $eventId = $photo->event_id;

        // 1. Delete original stored photo file from disk
        $srcPath = $photo->file_path;
        if (! empty($srcPath)) {
            $storageRelative = preg_replace('#^/storage/#', '', $srcPath);
            $storageFile = storage_path('app/public/'.$storageRelative);
            if (file_exists($storageFile)) {
                @unlink($storageFile);
            }
            $publicFile = public_path(ltrim($srcPath, '/'));
            if (file_exists($publicFile)) {
                @unlink($publicFile);
            }
        }

        // 2. Delete burned-in watermarked preview from disk
        $wmPath = storage_path('app/public/uploads/demo/watermarked/'.$photo->id.'_wm.jpg');
        if (file_exists($wmPath)) {
            @unlink($wmPath);
        }

        $photo->delete();

        $event = Event::find($eventId);
        if ($event) {
            $event->update(['total_photos' => $event->photos()->count()]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Photo and stored files deleted successfully from server.',
                'event_id' => $eventId,
                'total_photos' => $event ? $event->total_photos : 0,
            ]);
        }

        return redirect()->route('admin.dummy.event', ['event_id' => $eventId])
            ->with('success', 'Photo and stored file removed successfully from folder.');
    }

    /**
     * Serve burned-in watermarked image for web preview (Anti-theft defense).
     * Even if inspected or opened in a new tab, users ONLY get the watermarked image.
     */
    public function protectedImage(Request $request, int $id)
    {
        $photo = EventPhoto::findOrFail($id);
        $watermarkedPath = storage_path('app/public/uploads/demo/watermarked/'.$photo->id.'_wm.jpg');

        $setting = WatermarkSetting::firstOrCreate(['user_id' => null]);
        $settingTimestamp = $setting->updated_at ? $setting->updated_at->timestamp : 0;

        if (! file_exists($watermarkedPath) || (file_exists($watermarkedPath) && filemtime($watermarkedPath) < $settingTimestamp)) {
            $this->generateWatermarkedPreview($photo);
        }

        if (! file_exists($watermarkedPath)) {
            abort(404, 'Protected preview could not be generated.');
        }

        $lastModified = filemtime($watermarkedPath);
        $etag = '"'.md5($lastModified.filesize($watermarkedPath)).'"';

        if ($request->header('If-None-Match') === $etag || $request->header('If-Modified-Since') === gmdate('D, d M Y H:i:s T', $lastModified)) {
            return response('', 304, [
                'Cache-Control' => 'public, max-age=604800, stale-while-revalidate=86400',
                'ETag' => $etag,
            ]);
        }

        return response()->file($watermarkedPath, [
            'Content-Type' => 'image/jpeg',
            'Cache-Control' => 'public, max-age=604800, stale-while-revalidate=86400',
            'ETag' => $etag,
            'Last-Modified' => gmdate('D, d M Y H:i:s T', $lastModified),
        ]);
    }

    /**
     * Generate burned-in watermarked preview image using PHP GD matching exact studio settings.
     * Prevents clean image theft by permanently embedding watermarks into pixels.
     * Supports:
     * - Logo, Text, and Both (stacked/combined)
     * - Single Large Hero Center, Fotto Pro / PhotoX Pro 5-point grid, Tiled Grid, Double Cross, Hex Mesh, Quad Corners
     * - Dynamic color, opacity, rotation, and post-purchase sponsor branding
     */
    public function generateWatermarkedPreview(EventPhoto $photo): string
    {
        @ini_set('memory_limit', '1024M');

        $watermarkedDir = storage_path('app/public/uploads/demo/watermarked');
        if (! is_dir($watermarkedDir)) {
            @mkdir($watermarkedDir, 0777, true);
        }
        $targetPath = $watermarkedDir.'/'.$photo->id.'_wm.jpg';

        $srcPath = $photo->file_path;
        $raw = null;

        if (str_starts_with($srcPath, 'http://') || str_starts_with($srcPath, 'https://')) {
            $sourceCacheDir = storage_path('app/public/uploads/demo/source');
            if (! is_dir($sourceCacheDir)) {
                @mkdir($sourceCacheDir, 0777, true);
            }
            $sourceCacheFile = $sourceCacheDir.'/'.md5($srcPath).'.jpg';

            if (file_exists($sourceCacheFile) && filesize($sourceCacheFile) > 1000) {
                $raw = @file_get_contents($sourceCacheFile);
            } else {
                $ctx = stream_context_create([
                    'http' => [
                        'timeout' => 8,
                        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n",
                    ],
                ]);
                $raw = @file_get_contents($srcPath, false, $ctx);
                if ($raw) {
                    @file_put_contents($sourceCacheFile, $raw);
                }
            }
        } else {
            $localFile = public_path(ltrim($srcPath, '/'));
            if (! file_exists($localFile)) {
                $localFile = storage_path('app/public/'.preg_replace('#^/storage/#', '', $srcPath));
            }
            if (file_exists($localFile)) {
                $raw = @file_get_contents($localFile);
            }
        }

        if (! $raw) {
            $raw = @file_get_contents('https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=80');
        }

        if (! $raw) {
            return '';
        }

        $im = @imagecreatefromstring($raw);
        if (! $im) {
            return '';
        }

        $w = imagesx($im);
        $h = imagesy($im);

        // Downsample if wide (> 1200px) for ultra-fast web loading and bandwidth protection
        $maxWidth = 1200;
        if ($w > $maxWidth) {
            $newW = $maxWidth;
            $newH = (int) round(($h / $w) * $maxWidth);
            $resized = imagecreatetruecolor($newW, $newH);
            imagecopyresampled($resized, $im, 0, 0, 0, 0, $newW, $newH, $w, $h);
            imagedestroy($im);
            $im = $resized;
            $w = $newW;
            $h = $newH;
        }

        imagealphablending($im, true);
        imagesavealpha($im, true);

        // Fetch dynamic user-saved watermark settings from Watermark Studio
        $setting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        $pattern = $setting->watermark_pattern ?? 'fotto_pro';
        $type = $setting->watermark_type ?? 'logo';
        $text = ! empty($setting->watermark_text) ? $setting->watermark_text : 'PhotoX';
        $opacityPercent = max(10, min(100, (int) ($setting->opacity ?? 65)));
        $rotation = (int) ($setting->rotation ?? -12);
        $fontSizeSetting = (int) ($setting->font_size ?? 25);
        $rawColor = $setting->watermark_color ?? '#ff8a00';

        // Parse hex color into RGB components
        $hex = ltrim($rawColor, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        if (strlen($hex) !== 6 || ! ctype_xdigit($hex)) {
            $hex = 'FF8A00'; // Default PhotoX Orange
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // GD alpha: 0 = completely opaque, 127 = 100% transparent
        $gdAlpha = (int) round(127 - (127 * ($opacityPercent / 100)));
        $textColor = imagecolorallocatealpha($im, $r, $g, $b, $gdAlpha);
        $shadowAlpha = min(120, $gdAlpha + 25);
        $shadowColor = imagecolorallocatealpha($im, 0, 0, 0, $shadowAlpha);
        $lineColor = imagecolorallocatealpha($im, $r, $g, $b, min(120, $gdAlpha + 35));

        $fontFile = '/usr/share/fonts/liberation-sans/LiberationSans-Bold.ttf';
        if (! file_exists($fontFile)) {
            $fontFile = '/usr/share/fonts/dejavu/DejaVuSansMono-Bold.ttf';
        }

        // Resolve logo path
        $logoPath = null;
        if (! empty($setting->logo_path)) {
            $cand = public_path(ltrim($setting->logo_path, '/'));
            if (file_exists($cand)) {
                $logoPath = $cand;
            }
        }
        if (! $logoPath) {
            $fallback = public_path('uploads/watermarks/swirl_logo.png');
            if (file_exists($fallback)) {
                $logoPath = $fallback;
            }
        }

        $baseScale = $w / 1000;
        $brandFontSize = max(14, (int) round($fontSizeSetting * $baseScale * 1.3));

        // 1. TILED PATTERN (Anti-AI High-Density Protection Grid matching Admin Studio 1:1)
        if ($pattern === 'tiled') {
            $density = $setting->watermark_density ?? 'high';
            $cols = ($density === 'ultra') ? 12 : (($density === 'medium') ? 7 : 9);
            $rows = ($density === 'ultra') ? 8 : (($density === 'medium') ? 5 : 6);
            $cellW = $w / $cols;
            $cellH = $h / $rows;

            // Anti-AI Continuous Diagonal Security Lines (Subtle & Elegant)
            if ($setting->has_anti_ai_lines ?? true) {
                imagesetthickness($im, 1);
                $wireGap = max(90, (int) ($w * 0.12));
                for ($d = -$h; $d <= $w + $h; $d += $wireGap) {
                    imageline($im, $d, 0, $d + $h, $h, $lineColor);
                    imageline($im, $d, $h, $d + $h, 0, $lineColor);
                }
            }

            // Balanced font size and logo size scaled to cell dimensions so they never overlap
            $tiledFontPt = max(9, (int) round($fontSizeSetting * ($w / 1000) * 0.72));
            $tiledLogoW = max(24, (int) round(($setting->logo_size ?? 45) * ($w / 1000) * 0.75));

            for ($r = 0; $r < $rows; $r++) {
                // Stagger alternate rows by 25% cell width for organic anti-AI protection
                $staggerX = ($r % 2 === 1) ? (int) ($cellW * 0.25) : 0;
                $cy = (int) round(($r + 0.5) * $cellH);

                for ($c = 0; $c < $cols; $c++) {
                    $cx = (int) round(($c + 0.5) * $cellW + $staggerX);

                    if ($type === 'logo') {
                        $this->renderWatermarkLogo($im, $logoPath, $tiledLogoW, $cx, $cy, $rotation, $opacityPercent);
                    } elseif ($type === 'text') {
                        $this->renderWatermarkText($im, $text, $fontFile, $tiledFontPt, $cx, $cy, $rotation, $textColor, $shadowColor);
                    } else { // both (stacked)
                        $halfLogoW = (int) round($tiledLogoW * 0.7);
                        $halfFontPt = max(8, (int) round($tiledFontPt * 0.75));
                        $this->renderWatermarkLogo($im, $logoPath, $halfLogoW, $cx, $cy - 8, $rotation, $opacityPercent);
                        $this->renderWatermarkText($im, $text, $fontFile, $halfFontPt, $cx, $cy + 10, $rotation, $textColor, $shadowColor);
                    }
                }
            }
        }
        // 2. SINGLE LARGE HERO CENTER PATTERN
        elseif ($pattern === 'single_large') {
            $singleSize = (int) ($setting->single_logo_size ?? 160);
            $scale = $w / 800;

            if ($type === 'logo') {
                $targetW = (int) round($singleSize * $scale);
                $targetW = max(50, min((int) ($w * 0.88), $targetW));
                $this->renderWatermarkLogo($im, $logoPath, $targetW, (int) ($w / 2), (int) ($h / 2), $rotation, $opacityPercent);
            } elseif ($type === 'text') {
                $targetFontPt = max(16, (int) round($singleSize * 0.35 * $scale));
                if (file_exists($fontFile)) {
                    $bbox = imagettfbbox($targetFontPt, 0, $fontFile, $text);
                    $tw = abs($bbox[2] - $bbox[0]);
                    $maxAllowedW = (int) ($w * 0.82);
                    if ($tw > $maxAllowedW && $tw > 0) {
                        $targetFontPt = max(12, (int) round($targetFontPt * ($maxAllowedW / $tw)));
                    }
                    $this->renderWatermarkText($im, $text, $fontFile, $targetFontPt, (int) ($w / 2), (int) ($h / 2), $rotation, $textColor, $shadowColor);
                }
            } else { // both
                $logoTargetW = (int) round($singleSize * 0.65 * $scale);
                $logoTargetW = max(45, min((int) ($w * 0.75), $logoTargetW));
                $targetFontPt = max(14, (int) round($singleSize * 0.25 * $scale));

                if (file_exists($fontFile)) {
                    $bbox = imagettfbbox($targetFontPt, 0, $fontFile, $text);
                    $tw = abs($bbox[2] - $bbox[0]);
                    $maxAllowedW = (int) ($w * 0.75);
                    if ($tw > $maxAllowedW && $tw > 0) {
                        $targetFontPt = max(11, (int) round($targetFontPt * ($maxAllowedW / $tw)));
                    }
                }

                $gap = (int) round(10 * $scale);
                $halfOffset = (int) round($singleSize * 0.16 * $scale);

                $this->renderWatermarkLogo($im, $logoPath, $logoTargetW, (int) ($w / 2), (int) ($h / 2 - $halfOffset - $gap / 2), $rotation, $opacityPercent);
                $this->renderWatermarkText($im, $text, $fontFile, $targetFontPt, (int) ($w / 2), (int) ($h / 2 + $halfOffset + $gap / 2), $rotation, $textColor, $shadowColor);
            }
        }
        // 3. DOUBLE X-CROSS SHIELD PATTERN
        elseif ($pattern === 'double_cross') {
            imagesetthickness($im, 2);
            imageline($im, 0, 0, $w, $h, $lineColor);
            imageline($im, 0, $h, $w, 0, $lineColor);
            $radius = (int) ($w * 0.22);
            imageellipse($im, (int) ($w / 2), (int) ($h / 2), $radius, $radius, $lineColor);

            $centerSize = max(20, (int) ($brandFontSize * 1.3));
            $centerLogoW = max(50, (int) round($w * 0.18));

            if ($type === 'logo') {
                $this->renderWatermarkLogo($im, $logoPath, $centerLogoW, (int) ($w / 2), (int) ($h / 2), $rotation, $opacityPercent);
            } elseif ($type === 'text') {
                $this->renderWatermarkText($im, $text, $fontFile, $centerSize, (int) ($w / 2), (int) ($h / 2), $rotation, $textColor, $shadowColor);
            } else {
                $this->renderWatermarkLogo($im, $logoPath, (int) round($centerLogoW * 0.75), (int) ($w / 2), (int) ($h / 2 - 12), $rotation, $opacityPercent);
                $this->renderWatermarkText($im, $text, $fontFile, max(11, (int) round($centerSize * 0.75)), (int) ($w / 2), (int) ($h / 2 + 16), $rotation, $textColor, $shadowColor);
            }
        }
        // 4. HEX MESH SECURITY PATTERN
        elseif ($pattern === 'hex_mesh') {
            imagesetthickness($im, 1);
            $hexStep = max(80, (int) ($w * 0.12));
            for ($x = 0; $x <= $w; $x += $hexStep) {
                imageline($im, $x, 0, $x, $h, $lineColor);
            }
            for ($y = 0; $y <= $h; $y += $hexStep) {
                imageline($im, 0, $y, $w, $y, $lineColor);
            }

            $centerSize = max(22, (int) ($brandFontSize * 1.4));
            $centerLogoW = max(50, (int) round($w * 0.18));

            if ($type === 'logo') {
                $this->renderWatermarkLogo($im, $logoPath, $centerLogoW, (int) ($w / 2), (int) ($h / 2), $rotation, $opacityPercent);
            } elseif ($type === 'text') {
                $this->renderWatermarkText($im, $text, $fontFile, $centerSize, (int) ($w / 2), (int) ($h / 2), $rotation, $textColor, $shadowColor);
            } else {
                $this->renderWatermarkLogo($im, $logoPath, (int) round($centerLogoW * 0.75), (int) ($w / 2), (int) ($h / 2 - 12), $rotation, $opacityPercent);
                $this->renderWatermarkText($im, $text, $fontFile, max(11, (int) round($centerSize * 0.75)), (int) ($w / 2), (int) ($h / 2 + 16), $rotation, $textColor, $shadowColor);
            }
        }
        // 5. QUAD CORNERS ANTI-CROP PATTERN
        elseif ($pattern === 'quad_corners') {
            imagesetthickness($im, 4);
            $bracketLen = max(30, (int) ($w * 0.05));
            $pad = (int) ($w * 0.03);
            imageline($im, $pad, $pad, $pad + $bracketLen, $pad, $textColor);
            imageline($im, $pad, $pad, $pad, $pad + $bracketLen, $textColor);
            imageline($im, $w - $pad, $pad, $w - $pad - $bracketLen, $pad, $textColor);
            imageline($im, $w - $pad, $pad, $w - $pad, $pad + $bracketLen, $textColor);
            imageline($im, $pad, $h - $pad, $pad + $bracketLen, $h - $pad, $textColor);
            imageline($im, $pad, $h - $pad, $pad, $h - $pad - $bracketLen, $textColor);
            imageline($im, $w - $pad, $h - $pad, $w - $pad - $bracketLen, $h - $pad, $textColor);
            imageline($im, $w - $pad, $h - $pad, $w - $pad, $h - $pad - $bracketLen, $textColor);

            $centerSize = max(20, (int) ($brandFontSize * 1.3));
            $centerLogoW = max(50, (int) round($w * 0.18));

            if ($type === 'logo') {
                $this->renderWatermarkLogo($im, $logoPath, $centerLogoW, (int) ($w / 2), (int) ($h / 2), $rotation, $opacityPercent);
            } elseif ($type === 'text') {
                $this->renderWatermarkText($im, $text, $fontFile, $centerSize, (int) ($w / 2), (int) ($h / 2), $rotation, $textColor, $shadowColor);
            } else {
                $this->renderWatermarkLogo($im, $logoPath, (int) round($centerLogoW * 0.75), (int) ($w / 2), (int) ($h / 2 - 12), $rotation, $opacityPercent);
                $this->renderWatermarkText($im, $text, $fontFile, max(11, (int) round($centerSize * 0.75)), (int) ($w / 2), (int) ($h / 2 + 16), $rotation, $textColor, $shadowColor);
            }
        }
        // 6. PHOTOX PRO GRID (Default)
        else {
            if ($setting->has_cross_lines) {
                imagesetthickness($im, 2);
                imageline($im, 0, 0, $w, $h, $lineColor);
                imageline($im, 0, $h, $w, 0, $lineColor);
            }

            $gridPositions = [
                [(int) ($w * 0.50), (int) ($h * 0.50)], // Center
                [(int) ($w * 0.24), (int) ($h * 0.20)], // Top Left
                [(int) ($w * 0.76), (int) ($h * 0.20)], // Top Right
                [(int) ($w * 0.24), (int) ($h * 0.85)], // Bottom Left
                [(int) ($w * 0.76), (int) ($h * 0.85)], // Bottom Right
            ];

            $gridLogoW = max(36, (int) round(($setting->logo_size ?? 45) * ($w / 800) * 2.2));

            foreach ($gridPositions as $pos) {
                if ($type === 'logo') {
                    $this->renderWatermarkLogo($im, $logoPath, $gridLogoW, $pos[0], $pos[1], $rotation, $opacityPercent);
                } elseif ($type === 'text') {
                    $this->renderWatermarkText($im, $text, $fontFile, $brandFontSize, $pos[0], $pos[1], $rotation, $textColor, $shadowColor);
                } else { // both
                    $halfLogoW = (int) round($gridLogoW * 0.75);
                    $halfFontPt = max(11, (int) round($brandFontSize * 0.75));
                    $this->renderWatermarkLogo($im, $logoPath, $halfLogoW, $pos[0], $pos[1] - 12, $rotation, $opacityPercent);
                    $this->renderWatermarkText($im, $text, $fontFile, $halfFontPt, $pos[0], $pos[1] + 16, $rotation, $textColor, $shadowColor);
                }
            }

            if ($setting->has_security_badge) {
                $badgeText = $setting->security_badge_text ?: 'Do not screenshot';
                $badgeFontSize = max(12, (int) ($w * 0.015));
                if (file_exists($fontFile)) {
                    $bbox = imagettfbbox($badgeFontSize, 0, $fontFile, $badgeText);
                    $bw = abs($bbox[4] - $bbox[0]) + 32;
                    $bh = abs($bbox[5] - $bbox[1]) + 16;
                    $bx = (int) (($w - $bw) / 2);
                    $by = (int) ($h * 0.88 - $bh / 2);

                    $pillBg = imagecolorallocatealpha($im, 0, 0, 0, 80);
                    $pillBorder = imagecolorallocatealpha($im, $r, $g, $b, min(120, $gdAlpha + 10));
                    imagefilledrectangle($im, $bx, $by, $bx + $bw, $by + $bh, $pillBg);
                    imagesetthickness($im, 2);
                    imagerectangle($im, $bx, $by, $bx + $bw, $by + $bh, $pillBorder);

                    $btx = $bx + 16;
                    $bty = $by + $bh - 8;
                    imagettftext($im, $badgeFontSize, 0, $btx + 1, $bty + 1, $shadowColor, $fontFile, $badgeText);
                    imagettftext($im, $badgeFontSize, 0, $btx, $bty, $textColor, $fontFile, $badgeText);
                }
            }
        }

        // Post-purchase sponsor branding (if enabled)
        if ($setting->is_post_purchase_enabled && ($setting->post_purchase_mode ?? 'clean') === 'sponsor_branded') {
            $sponsorPath = null;
            if (! empty($setting->sponsor_logo_path)) {
                $cand = public_path(ltrim($setting->sponsor_logo_path, '/'));
                if (file_exists($cand)) {
                    $sponsorPath = $cand;
                }
            }

            if ($sponsorPath) {
                $spSize = (int) ($setting->sponsor_logo_size ?? 50);
                $spW = max(35, (int) round($spSize * ($w / 800) * 1.8));
                $spMargin = (int) round(($setting->sponsor_margin ?? 0) * ($w / 800) + 16);
                $spPlacement = $setting->sponsor_placement ?? 'bottom_right';
                $spOpacity = (int) ($setting->sponsor_opacity ?? 90);

                $spH = (int) round($spW * 0.45);
                $scx = $w - $spMargin - (int) ($spW / 2);
                $scy = $h - $spMargin - (int) ($spH / 2);

                if ($spPlacement === 'bottom_left') {
                    $scx = $spMargin + (int) ($spW / 2);
                    $scy = $h - $spMargin - (int) ($spH / 2);
                } elseif ($spPlacement === 'top_right') {
                    $scx = $w - $spMargin - (int) ($spW / 2);
                    $scy = $spMargin + (int) ($spH / 2);
                } elseif ($spPlacement === 'top_left') {
                    $scx = $spMargin + (int) ($spW / 2);
                    $scy = $spMargin + (int) ($spH / 2);
                } elseif ($spPlacement === 'middle_bottom') {
                    $scx = (int) ($w / 2);
                    $scy = $h - $spMargin - (int) ($spH / 2);
                }

                $this->renderWatermarkLogo($im, $sponsorPath, $spW, $scx, $scy, 0, $spOpacity);
            }
        }

        imagejpeg($im, $targetPath, 80);
        @chmod($targetPath, 0777);
        imagedestroy($im);

        return $targetPath;
    }

    /**
     * Render a transparent watermark logo onto a GD canvas with custom rotation, opacity, and scaling.
     */
    private function renderWatermarkLogo($im, ?string $logoPath, int $targetW, int $cx, int $cy, int $angleDeg, int $opacityPercent): void
    {
        if (! $logoPath || ! file_exists($logoPath) || $targetW <= 0) {
            return;
        }

        $raw = @file_get_contents($logoPath);
        if (! $raw) {
            return;
        }

        $logo = @imagecreatefromstring($raw);
        if (! $logo) {
            return;
        }

        $lw = imagesx($logo);
        $lh = imagesy($logo);
        if ($lw <= 0 || $lh <= 0) {
            imagedestroy($logo);

            return;
        }

        $targetH = (int) max(1, round(($lh / $lw) * $targetW));
        $scaled = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($scaled, false);
        imagesavealpha($scaled, true);
        $trans = imagecolorallocatealpha($scaled, 0, 0, 0, 127);
        imagefill($scaled, 0, 0, $trans);
        imagecopyresampled($scaled, $logo, 0, 0, 0, 0, $targetW, $targetH, $lw, $lh);
        imagedestroy($logo);

        $opacityFactor = max(0.05, min(1.0, $opacityPercent / 100));
        for ($x = 0; $x < $targetW; $x++) {
            for ($y = 0; $y < $targetH; $y++) {
                $color = imagecolorat($scaled, $x, $y);
                $a = ($color >> 24) & 0x7F;
                if ($a < 127) {
                    $r = ($color >> 16) & 0xFF;
                    $g = ($color >> 8) & 0xFF;
                    $b = $color & 0xFF;
                    $newA = 127 - (int) round((127 - $a) * $opacityFactor);
                    $newA = max(0, min(127, $newA));
                    imagesetpixel($scaled, $x, $y, imagecolorallocatealpha($scaled, $r, $g, $b, $newA));
                }
            }
        }

        if ($angleDeg != 0) {
            $stamp = imagerotate($scaled, -$angleDeg, $trans);
            imagealphablending($stamp, false);
            imagesavealpha($stamp, true);
            imagedestroy($scaled);
        } else {
            $stamp = $scaled;
        }

        $sw = imagesx($stamp);
        $sh = imagesy($stamp);
        $dx = (int) round($cx - $sw / 2);
        $dy = (int) round($cy - $sh / 2);

        imagealphablending($im, true);
        imagecopy($im, $stamp, $dx, $dy, 0, 0, $sw, $sh);
        imagedestroy($stamp);
    }

    /**
     * Render clean, sharp, rotated text with drop shadow centered precisely at ($cx, $cy).
     */
    private function renderWatermarkText($im, string $text, string $fontFile, int $fontPt, int $cx, int $cy, int $angleDeg, int $textColor, int $shadowColor): void
    {
        if (! file_exists($fontFile) || empty($text) || $fontPt <= 0) {
            return;
        }

        $bbox = imagettfbbox($fontPt, 0, $fontFile, $text);
        $tw = abs($bbox[2] - $bbox[0]);
        $th = abs($bbox[7] - $bbox[1]);

        $rad = deg2rad(-$angleDeg);
        $unrotCx = $tw / 2;
        $unrotCy = -$th / 2;

        $rotCx = $unrotCx * cos($rad) + $unrotCy * sin($rad);
        $rotCy = -$unrotCx * sin($rad) + $unrotCy * cos($rad);

        $originX = (int) round($cx - $rotCx);
        $originY = (int) round($cy - $rotCy);

        // Subtle drop shadow
        imagettftext($im, $fontPt, -$angleDeg, $originX + 2, $originY + 2, $shadowColor, $fontFile, $text);
        // Foreground text
        imagettftext($im, $fontPt, -$angleDeg, $originX, $originY, $textColor, $fontFile, $text);
    }

    /**
     * Re-apply user's saved watermark settings from /admin/dummy to all photos in an event.
     */
    public function reapplyWatermarks(Request $request)
    {
        $eventId = (int) $request->input('event_id', 12);
        $event = Event::findOrFail($eventId);
        $photos = $event->photos;

        $count = 0;
        foreach ($photos as $photo) {
            $this->generateWatermarkedPreview($photo);
            $count++;
        }

        $setting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Re-applied saved watermark '{$setting->watermark_pattern}' (Color: {$setting->watermark_color}) to all {$count} photos!",
                'count' => $count,
            ]);
        }

        return redirect()->route('admin.dummy.event', ['event_id' => $eventId])
            ->with('success', "Re-applied saved watermark '{$setting->watermark_pattern}' (Color: {$setting->watermark_color}) to all {$count} photos successfully!");
    }

    /**
     * Delete a dummy event along with all its photos and files from disk.
     */
    public function adminDeleteEvent(Request $request, int $id)
    {
        $event = Event::where('is_demo', true)->findOrFail($id);

        foreach ($event->photos as $photo) {
            $srcPath = $photo->file_path;
            if (! empty($srcPath)) {
                $storageRelative = preg_replace('#^/storage/#', '', $srcPath);
                $storageFile = storage_path('app/public/'.$storageRelative);
                if (file_exists($storageFile)) {
                    @unlink($storageFile);
                }
                $publicFile = public_path(ltrim($srcPath, '/'));
                if (file_exists($publicFile)) {
                    @unlink($publicFile);
                }
            }
            $wmPath = storage_path('app/public/uploads/demo/watermarked/'.$photo->id.'_wm.jpg');
            if (file_exists($wmPath)) {
                @unlink($wmPath);
            }
            $photo->delete();
        }

        if (! empty($event->cover_image) && str_starts_with($event->cover_image, '/storage/')) {
            $coverFile = storage_path('app/public/'.preg_replace('#^/storage/#', '', $event->cover_image));
            if (file_exists($coverFile)) {
                @unlink($coverFile);
            }
        }

        $event->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Event and all its photos removed cleanly.']);
        }

        return redirect()->route('admin.dummy.event')->with('success', 'Event and associated photos deleted successfully.');
    }

    /**
     * Frontend Sandbox / Dummy Home Page.
     * Retains 100% of the live home page structure and design,
     * while demonstrating dummy events, burned-in watermarks,
     * anti-inspection protection, EXIF metadata and commercial pricing.
     */
    public function dummyHome(Request $request): View
    {
        $banners = Banner::where('is_active', true)
            ->whereIn('placement', ['events_hero', 'explore_hero'])
            ->orderBy('sort_order')
            ->get();

        $imagePreviewBanner = Banner::where('is_active', true)
            ->where('placement', 'image_preview')
            ->orderBy('sort_order')
            ->first();

        $pageHeroes = PageHero::all()->keyBy('page');

        $categories = Category::where('is_active', true)->orderBy('name', 'asc')->get();
        $popularCategories = Category::where('is_active', true)
            ->orderByRaw('CASE WHEN sort_order > 0 THEN sort_order ELSE 9999 END ASC, name ASC')
            ->take(8)
            ->get();

        // 1. Latest Events with Photographer and photos count
        $latestEvents = Event::where('status', 'published')
            ->with(['photographer', 'category', 'photos'])
            ->withCount('photos')
            ->latest('event_date')
            ->get();

        if ($latestEvents->isEmpty()) {
            $latestEvents = Event::with(['photographer', 'category', 'photos'])
                ->withCount('photos')
                ->latest()
                ->take(6)
                ->get();
        }

        // 2. Browse every gallery (photos added to demo events with watermark)
        $photosQuery = EventPhoto::where('is_demo', true)->with(['event.category', 'photographer'])->latest();

        if ($request->filled('event_id')) {
            $photosQuery->where('event_id', (int) $request->input('event_id'));
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $cat = $request->input('category');
            $photosQuery->whereHas('event', function ($q) use ($cat) {
                $q->where('category_name', $cat);
            });
        }

        $galleryPhotos = $photosQuery->get();
        if ($galleryPhotos->isEmpty()) {
            $galleryPhotos = EventPhoto::with(['event.category', 'photographer'])->latest()->take(24)->get();
        }

        // 3. The 6 Verified Photographers for the Showcase Section
        $photographers = User::where('role', 'photographer')
            ->where('status', 'active')
            ->with(['membership', 'events'])
            ->withCount('events')
            ->orderByRaw("CASE WHEN tier = 'photoguild' THEN 0 WHEN tier = 'pro' THEN 1 WHEN tier = 'standard' THEN 2 ELSE 3 END")
            ->orderBy('id', 'asc')
            ->take(6)
            ->get();

        $watermarkSetting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        return view('demo.web-home', compact(
            'banners',
            'imagePreviewBanner',
            'pageHeroes',
            'categories',
            'popularCategories',
            'latestEvents',
            'galleryPhotos',
            'photographers',
            'watermarkSetting'
        ));
    }

    /**
     * Frontend Dummy Event Single View with full photo gallery & sandbox inspector.
     */
    public function dummyEventShow(Request $request, ?string $slug = null): View
    {
        $event = null;
        if ($request->filled('event_id')) {
            $event = Event::find($request->input('event_id'));
        } elseif (! empty($slug)) {
            $event = Event::where('slug', $slug)->first();
        }

        if (! $event) {
            $event = Event::whereHas('photos')->first() ?? Event::first();
        }

        $photos = EventPhoto::where('event_id', $event->id)->latest()->get();
        if ($photos->isEmpty()) {
            $photos = EventPhoto::where('is_demo', true)->latest()->take(16)->get();
        }

        $otherEvents = Event::where('is_demo', true)->where('id', '!=', $event->id)->get();
        $watermarkSetting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        return view('demo.dummy-event-detail', compact('event', 'photos', 'otherEvents', 'watermarkSetting'));
    }

    /**
     * Extract detailed EXIF metadata from photo file.
     *
     * @return array<string, mixed>
     */
    private function extractExif(string $filePath): array
    {
        $meta = [
            'camera_make' => null,
            'camera_model' => null,
            'lens' => null,
            'focal_length' => null,
            'shutter_speed' => null,
            'aperture' => null,
            'iso' => null,
            'flash' => null,
            'dimensions' => null,
            'file_size' => null,
            'captured_at' => null,
            'photographer_name' => null,
            'copyright' => null,
        ];

        if (file_exists($filePath)) {
            $bytes = filesize($filePath);
            $meta['file_size'] = round($bytes / (1024 * 1024), 2).' MB';

            $imgSize = @getimagesize($filePath);
            if ($imgSize) {
                $mp = round(($imgSize[0] * $imgSize[1]) / 1000000, 1);
                $meta['dimensions'] = "{$mp}MP • {$imgSize[0]} x {$imgSize[1]}";
            }

            if (function_exists('exif_read_data')) {
                $exif = @exif_read_data($filePath);
                if ($exif && is_array($exif)) {
                    $meta['camera_make'] = $exif['Make'] ?? null;
                    $meta['camera_model'] = $exif['Model'] ?? null;
                    $meta['lens'] = $exif['UndefinedTag:0xA434'] ?? ($exif['LensModel'] ?? ($exif['LensInfo'] ?? null));

                    if (! empty($exif['FocalLength'])) {
                        $meta['focal_length'] = is_numeric($exif['FocalLength']) ? $exif['FocalLength'].'mm' : $exif['FocalLength'];
                    }

                    if (! empty($exif['ExposureTime'])) {
                        $meta['shutter_speed'] = $exif['ExposureTime'];
                    }

                    if (! empty($exif['FNumber'])) {
                        $meta['aperture'] = 'f/'.(is_numeric($exif['FNumber']) ? round($exif['FNumber'], 1) : $exif['FNumber']);
                    }

                    if (! empty($exif['ISOSpeedRatings'])) {
                        $meta['iso'] = is_array($exif['ISOSpeedRatings']) ? $exif['ISOSpeedRatings'][0] : $exif['ISOSpeedRatings'];
                    }

                    if (isset($exif['Flash'])) {
                        $meta['flash'] = ($exif['Flash'] & 1) ? 'On' : 'Off';
                    }

                    if (! empty($exif['DateTimeOriginal'])) {
                        $meta['captured_at'] = date('Y-m-d H:i:s', strtotime($exif['DateTimeOriginal']));
                    }

                    if (! empty($exif['Artist'])) {
                        $meta['photographer_name'] = $exif['Artist'];
                    }

                    if (! empty($exif['Copyright'])) {
                        $meta['copyright'] = $exif['Copyright'];
                    }
                }
            }

            // Fallback for demo display if photo was stripped of EXIF (e.g. web exports)
            if (empty($meta['camera_model'])) {
                $meta['camera_model'] = 'Canon EOS R5';
                $meta['lens'] = 'RF100-300mm F2.8 L IS USM';
                $meta['focal_length'] = '300mm';
                $meta['shutter_speed'] = '1/3200';
                $meta['aperture'] = 'f/2.8';
                $meta['iso'] = '200';
                $meta['flash'] = 'Off';
                $meta['captured_at'] = now()->format('Y-m-d H:i:s');
            }
        }

        return $meta;
    }
}
