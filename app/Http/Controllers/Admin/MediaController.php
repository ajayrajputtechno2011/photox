<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display the Media Library view.
     */
    public function index(Request $request): View
    {
        $query = MediaAsset::latest();

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('filename', 'like', "%{$q}%")
                    ->orWhere('original_name', 'like', "%{$q}%")
                    ->orWhere('title', 'like', "%{$q}%");
            });
        }

        if ($request->filled('folder') && $request->input('folder') !== 'all') {
            $query->where('folder', $request->input('folder'));
        }

        $assets = $query->paginate(24)->withQueryString();
        $totalCount = MediaAsset::count();
        $totalBytes = MediaAsset::sum('file_size');

        $totalMb = round($totalBytes / (1024 * 1024), 2);

        return view('admin.media', compact('assets', 'totalCount', 'totalMb'));
    }

    /**
     * API list for Media Picker modal.
     */
    public function apiList(Request $request): JsonResponse
    {
        $query = MediaAsset::latest();

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('filename', 'like', "%{$q}%")
                    ->orWhere('original_name', 'like', "%{$q}%")
                    ->orWhere('title', 'like', "%{$q}%");
            });
        }

        $assets = $query->paginate(36);

        return response()->json([
            'success' => true,
            'data' => $assets->items(),
            'current_page' => $assets->currentPage(),
            'last_page' => $assets->lastPage(),
            'total' => $assets->total(),
        ]);
    }

    /**
     * Store uploaded media file(s).
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'files' => 'nullable|array',
            'files.*' => 'image|max:15360', // up to 15MB each
            'file' => 'nullable|image|max:15360',
            'title' => 'nullable|string|max:255',
            'folder' => 'nullable|string|max:50',
        ]);

        $folder = $request->input('folder', 'banners');
        $uploaded = [];

        $filesToProcess = [];
        if ($request->hasFile('files')) {
            $filesToProcess = $request->file('files');
        } elseif ($request->hasFile('file')) {
            $filesToProcess = [$request->file('file')];
        }

        if (empty($filesToProcess)) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'No files provided.'], 422);
            }

            return back()->with('error', 'Please choose at least one image file to upload.');
        }

        foreach ($filesToProcess as $file) {
            $originalName = $file->getClientOriginalName();
            $path = $file->store($folder, 'public');
            $filePath = '/storage/'.$path;
            $fullDiskPath = storage_path('app/public/'.$path);

            $dims = null;
            if (file_exists($fullDiskPath) && @getimagesize($fullDiskPath)) {
                $info = getimagesize($fullDiskPath);
                $dims = $info[0].'x'.$info[1];
            }

            $asset = MediaAsset::create([
                'filename' => basename($path),
                'original_name' => $originalName,
                'file_path' => $filePath,
                'disk' => 'public',
                'mime_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'dimensions' => $dims,
                'title' => $request->input('title') ?: pathinfo($originalName, PATHINFO_FILENAME),
                'folder' => $folder,
            ]);

            $uploaded[] = $asset;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => count($uploaded).' media item(s) uploaded successfully.',
                'uploaded' => $uploaded,
            ]);
        }

        return redirect()->route('admin.media.index')->with('success', count($uploaded).' media file(s) uploaded successfully.');
    }

    /**
     * Delete a media asset.
     */
    public function destroy(Request $request, MediaAsset $media): JsonResponse|RedirectResponse
    {
        if (! empty($media->file_path) && str_starts_with($media->file_path, '/storage/')) {
            $relative = str_replace('/storage/', '', $media->file_path);
            if (Storage::disk('public')->exists($relative)) {
                Storage::disk('public')->delete($relative);
            }
        }

        $media->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Media asset deleted successfully.',
            ]);
        }

        return redirect()->route('admin.media.index')->with('success', 'Media asset deleted successfully.');
    }
}
