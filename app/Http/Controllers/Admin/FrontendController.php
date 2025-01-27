<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Helpline;
use App\Models\HomepageCMS;
use App\Models\ImportantNotice;
use App\Models\Tender;
use App\Models\TenderCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontendController extends Controller
{

    public function index()
    {
        $homepage_cms = HomepageCMS::first();
        $helplines = Helpline::where('status', 1)->get();
        $notices = ImportantNotice::where('status', 1)->orderBy('id', 'desc')->get();
    
        $categories = TenderCategory::with([
            'subCategories',
            'subCategories.tenders' => function ($query) {
                $query->where('tender_type', 0)
                    ->where('status', 1)
                    ->where(function ($query) {
                        $query->where('tender_validity', '>=', Carbon::today())
                              ->orWhereRaw("DATE_ADD(tender_validity, INTERVAL 7 DAY) >= ?", [Carbon::today()]);
                    })
                    ->with('district') // Ensure district relation is loaded
                    ->select('link_name', 'id', 'created_at', 'sub_category_id', 'tender_validity', 'district_id') // Include district_id
                    ->orderBy('created_at', 'desc');
            }
        ])->get();
    
        $districts = District::orderBy('district_name', 'asc')->get();
    
        return view('frontend.home.index', compact('categories', 'homepage_cms', 'helplines', 'notices', 'districts'));
    }
    





    public function categoryWiseTender($id)
    {
        $homepage_cms = HomepageCMS::first();
        $helplines = Helpline::where('status', 1)->get();
        
        $category = TenderCategory::with(['subCategories.tenders' => function ($query) {
            $query->where('tender_type', 0)
                ->where('status', 1)
                ->where(function ($query) {
                    $query->where('tender_validity', '>=', Carbon::today()) // Valid tenders from today onwards
                          ->orWhereRaw("DATE_ADD(tender_validity, INTERVAL 7 DAY) >= ?", [Carbon::today()]); // Expired tenders up to 7 days ago
                })
                ->with('district:id,district_name') // Include district data
                ->select('link_name', 'id', 'created_at', 'tender_validity', 'sub_category_id', 'district_id') // Include district_id for relationship
                ->orderBy('created_at', 'desc'); // Sort tenders by the latest created date
        }])->findOrFail($id);
    
        return view('frontend.tender.category_wise_tender', compact('category', 'homepage_cms', 'helplines'));
    }
    
    

    public function previewFrontTender($id)
    {
        $homepage_cms = HomepageCMS::first();
        $helplines = Helpline::where('status', 1)->get();
        $tender = Tender::find($id);
        return view('frontend.tender.preview', [
            'tender' => $tender,
            'homepage_cms' => $homepage_cms,
            'helplines' => $helplines,
            
        ]);
    }
}
