<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tender;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AjaxController extends Controller
{

    public function sortTender($id)
    {
        $tenderQuery = Tender::where('status', 1)
            ->where('tender_type', 1)
            ->where(function ($query) use ($id) {
                if ($id != 'all') {
                    $query->where('district_id', $id); // Filter by district if not 'all'
                }
            })
            ->where(function ($query) {
                $query->where('tender_validity', '>=', Carbon::today()) // Valid tenders from today onwards
                      ->orWhereRaw("DATE_ADD(tender_validity, INTERVAL 7 DAY) >= ?", [Carbon::today()]); // Expired tenders up to 7 days ago
            });
    
        $tender_list = $tenderQuery->orderBy('link_name', 'asc')->get();
    
        if ($tender_list->isNotEmpty()) {
            return view('backend.ajax_filter.show', compact('tender_list'))->render();
        } else {
            return response()->json([
                'status' => 'nothing found',
            ]);
        }
    }
    


    public function searchTender(Request $request)
    {
        $search_string = $request->input('search_string');
    
        $tender_search = Tender::where('status', 1)
            ->where('tender_type', 1)
            ->whereHas('subCategory', function ($query) use ($search_string) {
                $query->where('sub_category_name', 'like', '%' . $search_string . '%');
            })
            ->select('link_name', 'id', 'created_at', 'sub_category_id', 'tender_validity')
            ->where(function ($query) {
                $query->where('tender_validity', '>=', Carbon::today()) // Valid tenders from today onwards
                      ->orWhereRaw("DATE_ADD(tender_validity, INTERVAL 7 DAY) >= ?", [Carbon::today()]); // Expired tenders up to 7 days ago
            })
            ->orderBy('id', 'desc')
            ->get();
    
        if ($tender_search->count() >= 1) {
            return view('backend.ajax_search.show', [
                'tender_search' => $tender_search,
            ])->render();
        } else {
            return response()->json([
                'status' => 'nothing found',
            ]);
        }
    }
    
}
