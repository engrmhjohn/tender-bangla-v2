<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenderCategory;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function generateSitemap()
    {
        $urls = [];
    
        // Dynamic URLs for Tender Categories
        $categories = TenderCategory::with(['subCategories.tenders'])->get();
    
        foreach ($categories as $category) {
            // Category URL
            $urls[] = [
                'loc' => route('category_wise_tender', ['id' => $category->id]),
                'lastmod' => $category->updated_at ? $category->updated_at->toAtomString() : now()->toAtomString(),
            ];
    
            // Tenders under subcategories
            foreach ($category->subCategories as $subCategory) {
                foreach ($subCategory->tenders as $tender) {
                    $urls[] = [
                        'loc' => route('preview_front_tender', ['id' => $tender->id]),
                        'lastmod' => $tender->updated_at ? $tender->updated_at->toAtomString() : now()->toAtomString(),
                    ];
                }
            }
        }
    
        // Return the XML Sitemap
        return response()
            ->view('frontend.sitemap.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }    
}
