<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;
use App\Models\ShortLink;

class ManualController extends Controller
{
    public function show($brand_id, $brand_slug, $manual_id )
    {
        $brand = Brand::findOrFail($brand_id);
    $manual = Manual::findOrFail($manual_id);

    // Increment visits atomically each time the manual page is viewed
    $manual->increment('visits');

        return view('pages/manual_view', [
            "manual" => $manual,
            "brand" => $brand,
        ]);
    }

    public function getShortLink($brand_id, $brand_slug, $manual_id)
    {
        $manual = Manual::findOrFail($manual_id);
        
        $shortLink = ShortLink::firstOrCreate(
            ['manual_id' => $manual->id],
            ['code' => ShortLink::generateUniqueCode()]
        );

        return response()->json([
            'short_url' => url("/link/{$shortLink->code}")
        ]);
    }
}
