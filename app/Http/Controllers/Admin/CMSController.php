<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Helpline;
use App\Models\HomepageCMS;
use App\Models\ImportantNotice;
use App\Models\PackageInfo;
use App\Models\Tender;
use App\Models\TenderCategory;
use App\Models\TenderSubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

require_once app_path('Helper/image.php');

class CMSController extends Controller
{

    public function dashboard()
    {
        $userDistrictIds = json_decode(auth()->user()->district_id);
    
        // Fetch tenders filtered by user's districts, tender type 1, and tender validity
        $tenders = Tender::with(['subCategory', 'district']) // Load related subCategory and district
            ->whereIn('district_id', $userDistrictIds) // Filter by user's districts
            ->where('tender_type', 1) // Filter for tender type 1
            ->where(function ($query) {
                $query->where('tender_validity', '>=', Carbon::today()) // Future tenders
                      ->orWhereRaw("DATE_ADD(tender_validity, INTERVAL 7 DAY) >= ?", [Carbon::today()]); // Expired tenders within 7 days
            })
            ->orderBy('id', 'desc') // Order by latest tenders
            ->select('link_name', 'id', 'created_at', 'sub_category_id', 'tender_validity', 'district_id') // Include district_id for relation
            ->get();
    
        // Fetch district names for display in the view
        $districtNames = District::whereIn('id', $userDistrictIds)->pluck('district_name');
        $package_info = PackageInfo::orderBy('id', 'desc')->first();
    
        return view('backend.home.index', compact('tenders', 'districtNames', 'package_info'));
    }
    


    public function addPackageInfo()
    {
        return view('backend.cms.package_info.show');
    }

    public function savePackageInfo(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required|image',
        ], [
            'description.required' => 'Tender Description is required.',
            'image.image' => 'Tender Package Image must be a valid image format.',

        ]);
        $package_info = new PackageInfo();
        $package_info->description = $request->description;
        $package_info->image = image_upload($request->image);
        $package_info->save();
        return redirect(route('manage_package_info'))->with('message', 'Successfully Added!');
    }

    public function managePackageInfo()
    {
        return view('backend.cms.package_info.index', [
            'package_info' => PackageInfo::orderBy('id', 'desc')->first()
        ]);
    }

    public function editPackageInfo($id)
    {
        $package_info = PackageInfo::find($id);
        return view('backend.cms.package_info.edit', [
            'package_info' => $package_info
        ]);
    }

    public function updatePackageInfo(Request $request)
    {
        $package_info               = PackageInfo::find($request->package_info_id);
        $package_info->description = $request->description;
        if ($request->file('image')) {
            if (isset($package_info)) {
                delete_image($package_info->image);
                $package_info->delete();
            }
            $package_info->image = image_upload($request->image);
        }
        $package_info->save();
        return redirect(route('manage_package_info'))->with('message', 'Successfully Updated!');
    }



    public function addTender()
    {
        return view('backend.cms.tender.show', [
            'districts' => District::orderby('district_name', 'asc')->get(),
            'sub_categories' => TenderSubCategory::orderby('sub_category_name', 'asc')->get(),
        ]);
    }


    public function saveTender(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'sub_category_id' => 'required',
            'link_name' => 'required|string|max:255',
            'tender_image_one' => 'required|image',
            'tender_image_two' => 'nullable|image',
            'tender_image_three' => 'nullable|image',
            'tender_image_four' => 'nullable|image',
            'tender_image_five' => 'nullable|image',
        ], [
            'tender_image_one.required' => 'Tender Image 01 is required.',
            'tender_image_one.image' => 'Tender Image 01 must be a valid image format.',
            'tender_image_two.image' => 'Tender Image 02 must be a valid image format.',
            'tender_image_three.image' => 'Tender Image 03 must be a valid image format.',
            'tender_image_four.image' => 'Tender Image 04 must be a valid image format.',
            'tender_image_five.image' => 'Tender Image 05 must be a valid image format.',
        ]);

        $tender = new Tender();
        $tender->district_id = $request->district_id;
        $tender->sub_category_id = $request->sub_category_id;
        $tender->link_name = $request->link_name;
        $tender->tender_image_one = image_upload($request->tender_image_one);
        $tender->tender_image_two = image_upload($request->tender_image_two);
        $tender->tender_image_three = image_upload($request->tender_image_three);
        $tender->tender_image_four = image_upload($request->tender_image_four);
        $tender->tender_image_five = image_upload($request->tender_image_five);
        $tender->tender_validity = $request->tender_validity;
        $tender->tender_type = $request->tender_type;
        $tender->status = $request->status;
        $tender->save();
        return redirect(route('manage_tender'))->with('message', 'Successfully Added!');
    }

    public function manageTender()
    {
        return view('backend.cms.tender.index', [
            'tender' => Tender::orderBy('id', 'asc')->get()
        ]);
    }

    public function editTender($id)
    {
        $tender = Tender::find($id);
        return view('backend.cms.tender.edit', [
            'districts' => District::orderby('district_name', 'asc')->get(),
            'tender' => $tender
        ]);
    }

    public function updateTender(Request $request)
    {
        $tender               = Tender::find($request->tender_id);
        $tender->district_id = $request->district_id;
        $tender->link_name = $request->link_name;
        $tender->tender_type = $request->tender_type;
        $tender->tender_validity = $request->tender_validity;
        $tender->status = $request->status;

        if ($request->file('tender_image_one')) {
            if (isset($tender)) {
                delete_image($tender->tender_image_one);
                $tender->delete();
            }
            $tender->tender_image_one = image_upload($request->tender_image_one);
        }


        if ($request->file('tender_image_two')) {
            if (isset($tender)) {
                delete_image($tender->tender_image_two);
                $tender->delete();
            }
            $tender->tender_image_two = image_upload($request->tender_image_two);
        }


        if ($request->file('tender_image_three')) {
            if (isset($tender)) {
                delete_image($tender->tender_image_three);
                $tender->delete();
            }
            $tender->tender_image_three = image_upload($request->tender_image_three);
        }


        if ($request->file('tender_image_four')) {
            if (isset($tender)) {
                delete_image($tender->tender_image_four);
                $tender->delete();
            }
            $tender->tender_image_four = image_upload($request->tender_image_four);
        }


        if ($request->file('tender_image_five')) {
            if (isset($tender)) {
                delete_image($tender->tender_image_five);
                $tender->delete();
            }
            $tender->tender_image_five = image_upload($request->tender_image_five);
        }
        $tender->save();
        return redirect(route('manage_tender'))->with('message', 'Successfully Updated!');
    }

    public function deleteTender(Request $request)
    {
        $tender = Tender::find($request->tender_id);
        if (isset($tender)) {
            delete_image($tender->tender_image_one);
            $tender->delete();
        }
        if (isset($tender)) {
            delete_image($tender->tender_image_two);
            $tender->delete();
        }
        if (isset($tender)) {
            delete_image($tender->tender_image_three);
            $tender->delete();
        }
        if (isset($tender)) {
            delete_image($tender->tender_image_four);
            $tender->delete();
        }
        if (isset($tender)) {
            delete_image($tender->tender_image_five);
            $tender->delete();
        }
        $tender->delete();
        return redirect()->route('manage_tender')->with('message', 'Successfully Deleted!');
    }


    public function previewTender($id)
    {
        $tender = Tender::find($id);
        return view('backend.cms.tender.preview', [
            'tender' => $tender
        ]);
    }


    public function allTender()
    {
        $data = [];
    
        // Fetch categories that have tenders, and sort tenders by latest created_at
        $categories = TenderCategory::with(['subCategories.tenders' => function ($query) {
            $query->where('tender_type', 1)
                ->where('status', 1)
                ->where(function ($query) {
                    $query->where('tender_validity', '>=', Carbon::today()) // Future tenders
                          ->orWhereRaw("DATE_ADD(tender_validity, INTERVAL 7 DAY) >= ?", [Carbon::today()]); // Expired tenders within 7 days
                })
                ->orderBy('created_at', 'desc'); // Order by latest
        }])->get();
    
        // Fetch districts
        $districts = District::orderBy('district_name', 'asc')->get();
    
        return view('backend.cms.tender.all_tender', compact('categories', 'districts', 'data'));
    }
    
    


    public function addTenderCategory()
    {
        return view('backend.cms.tender_category.show');
    }


    public function saveTenderCategory(Request $request)
    {
        $tender_category = new TenderCategory();
        $tender_category->category_name = $request->category_name;
        $tender_category->save();
        return redirect(route('manage_tender_category'))->with('message', 'Successfully Added!');
    }

    public function manageTenderCategory()
    {
        return view('backend.cms.tender_category.index', [
            'tender_category' => TenderCategory::orderBy('category_name', 'asc')->get()
        ]);
    }

    public function editTenderCategory($id)
    {
        $tender_category = TenderCategory::find($id);
        return view('backend.cms.tender_category.edit', [
            'tender_category' => $tender_category
        ]);
    }

    public function updateTenderCategory(Request $request)
    {
        $tender_category               = TenderCategory::find($request->tender_category_id);
        $tender_category->category_name = $request->category_name;
        $tender_category->save();
        return redirect(route('manage_tender_category'))->with('message', 'Successfully Updated!');
    }

    public function deleteTenderCategory(Request $request)
    {
        $tender_category = TenderCategory::find($request->tender_category_id);
        $tender_category->delete();
        return redirect()->route('manage_tender_category')->with('message', 'Successfully Deleted!');
    }



    public function addTenderSubCategory()
    {
        return view('backend.cms.tender_sub_category.show', [
            'categories' => TenderCategory::orderby('category_name', 'asc')->get(),
        ]);
    }


    public function saveTenderSubCategory(Request $request)
    {
        $request->validate([
            'logo' => 'required|image',
            'category_id' => 'required',
        ], [
            'logo.required' => 'The logo image is required.',
            'logo.image' => 'The logo must be a valid image format.',
            'category_id.required' => 'You must choose a category.',
        ]);
        $tender_sub_category = new TenderSubCategory();
        $tender_sub_category->category_id = $request->category_id;
        $tender_sub_category->sub_category_name = $request->sub_category_name;
        $tender_sub_category->logo = logo_upload($request->logo);
        $tender_sub_category->save();
        return redirect(route('manage_tender_sub_category'))->with('message', 'Successfully Added!');
    }

    public function manageTenderSubCategory()
    {
        return view('backend.cms.tender_sub_category.index', [
            'tender_sub_category' => TenderSubCategory::orderBy('sub_category_name', 'asc')->get()
        ]);
    }

    public function editTenderSubCategory($id)
    {
        $tender_sub_category = TenderSubCategory::find($id);
        return view('backend.cms.tender_sub_category.edit', [
            'categories' => TenderCategory::orderby('category_name', 'asc')->get(),
            'tender_sub_category' => $tender_sub_category
        ]);
    }

    public function updateTenderSubCategory(Request $request)
    {
        $tender_sub_category = TenderSubCategory::find($request->tender_sub_category_id);
        $tender_sub_category->category_id = $request->category_id;
        $tender_sub_category->sub_category_name = $request->sub_category_name;

        if ($request->file('logo')) {
            if (isset($tender_sub_category->logo)) {
                // Delete the old logo
                delete_image($tender_sub_category->logo);
            }
            // Upload the new logo
            $tender_sub_category->logo = logo_upload($request->logo);
        }

        $tender_sub_category->save();
        return redirect(route('manage_tender_sub_category'))->with('message', 'Successfully Updated!');
    }

    public function deleteTenderSubCategory(Request $request)
    {
        $tender_sub_category = TenderSubCategory::find($request->tender_sub_category_id);
        if (isset($tender_sub_category)) {
            delete_image($tender_sub_category->logo);
            $tender_sub_category->delete();
        }
        $tender_sub_category->delete();
        return redirect()->route('manage_tender_sub_category')->with('message', 'Successfully Deleted!');
    }



    public function addHomepageContent()
    {
        return view('backend.cms.frontpage.show');
    }


    public function saveHomepageContent(Request $request)
    {

        $request->validate([
            'logo' => 'required|image',
            'header_banner_image' => 'required|image',
            'login_register_btn_text' => 'required|string',
            'header_banner_text' => 'required|string',
            'header_btn_text' => 'required|string',
            'category_btn_text' => 'required|string',
            'contact_header_text' => 'required|string',
            'office_address' => 'required|string',
            'contact_email_one' => 'required|email',
            'contact_phone_one' => 'required|numeric',
        ], [
            'logo.required' => 'The logo image is required.',
            'logo.image' => 'The logo must be a valid image format.',
            'header_banner_image.required' => 'The header banner image is required.',
            'header_banner_image.image' => 'The header banner must be a valid image format.',
        ]);

        $homepage_cms = new HomepageCMS();


        $homepage_cms->logo = image_upload($request->logo);
        $homepage_cms->header_banner_image = banner_upload($request->header_banner_image);

        $homepage_cms->login_register_btn_text = $request->login_register_btn_text;
        $homepage_cms->header_banner_text = $request->header_banner_text;
        $homepage_cms->header_btn_text = $request->header_btn_text;
        $homepage_cms->category_btn_text = $request->category_btn_text;
        $homepage_cms->contact_header_text = $request->contact_header_text;
        $homepage_cms->office_address = $request->office_address;
        $homepage_cms->contact_email_one = $request->contact_email_one;
        $homepage_cms->contact_email_two = $request->contact_email_two;
        $homepage_cms->contact_phone_one = $request->contact_phone_one;
        $homepage_cms->contact_phone_two = $request->contact_phone_two;
        $homepage_cms->facebook_link = $request->facebook_link;
        $homepage_cms->youtube_link = $request->youtube_link;
        $homepage_cms->whatsapp_number = $request->whatsapp_number;

        $homepage_cms->save();

        return redirect()->back()->with('message', 'Successfully Added!');
    }


    public function manageHomepageContent()
    {
        return view('backend.cms.frontpage.edit', [
            'homepage_cms' => HomepageCMS::first()
        ]);
    }


    // public function editHomepageContent($id)
    // {
    //     $homepage_cms = HomepageCMS::find($id);
    //     return view('backend.cms.frontpage.edit', [
    //         'homepage_cms' => $homepage_cms
    //     ]);
    // }

    public function updateHomepageContent(Request $request)
    {

        $homepage_cms               = HomepageCMS::find($request->homepage_cms_id);
        $homepage_cms->login_register_btn_text = $request->login_register_btn_text;
        $homepage_cms->header_banner_text = $request->header_banner_text;
        $homepage_cms->header_btn_text = $request->header_btn_text;
        $homepage_cms->category_btn_text = $request->category_btn_text;
        $homepage_cms->contact_header_text = $request->contact_header_text;
        $homepage_cms->office_address = $request->office_address;
        $homepage_cms->contact_email_one = $request->contact_email_one;
        $homepage_cms->contact_email_two = $request->contact_email_two;
        $homepage_cms->contact_phone_one = $request->contact_phone_one;
        $homepage_cms->contact_phone_two = $request->contact_phone_two;
        $homepage_cms->facebook_link = $request->facebook_link;
        $homepage_cms->youtube_link = $request->youtube_link;
        $homepage_cms->whatsapp_number = $request->whatsapp_number;

        if ($request->file('logo')) {
            if (isset($homepage_cms)) {
                delete_image($homepage_cms->logo);
                $homepage_cms->delete();
            }
            $homepage_cms->logo = image_upload($request->logo);
        }
        if ($request->file('header_banner_image')) {
            if (isset($homepage_cms)) {
                delete_image($homepage_cms->header_banner_image);
                $homepage_cms->delete();
            }
            $homepage_cms->header_banner_image = banner_upload($request->header_banner_image);
        }
        $homepage_cms->save();
        return redirect()->back()->with('message', 'Successfully Updated!');
    }


    public function addHelpline()
    {
        return view('backend.cms.helpline.show');
    }


    public function saveHelpline(Request $request)
    {
        $helpline = new Helpline();
        $helpline->helpline_name = $request->helpline_name;
        $helpline->helpline_link = $request->helpline_link;
        $helpline->status = $request->status;
        $helpline->save();
        return redirect(route('manage_helpline'))->with('message', 'Successfully Added!');
    }

    public function manageHelpline()
    {
        return view('backend.cms.helpline.index', [
            'helpline' => Helpline::orderBy('id', 'desc')->get()
        ]);
    }

    public function editHelpline($id)
    {
        $helpline = Helpline::find($id);
        return view('backend.cms.helpline.edit', [
            'helpline' => $helpline
        ]);
    }

    public function updateHelpline(Request $request)
    {
        $helpline               = Helpline::find($request->helpline_id);
        $helpline->helpline_name = $request->helpline_name;
        $helpline->helpline_link = $request->helpline_link;
        $helpline->status = $request->status;
        $helpline->save();
        return redirect(route('manage_helpline'))->with('message', 'Successfully Updated!');
    }

    public function deleteHelpline(Request $request)
    {
        $helpline = Helpline::find($request->helpline_id);
        $helpline->delete();
        return redirect()->route('manage_helpline')->with('message', 'Successfully Deleted!');
    }

    public function addImportantNotice()
    {
        return view('backend.cms.important_notice.show');
    }


    public function saveImportantNotice(Request $request)
    {
        $important_notice = new ImportantNotice();
        $important_notice->notice_title = $request->notice_title;
        $important_notice->status = $request->status;
        $important_notice->save();
        return redirect(route('manage_important_notice'))->with('message', 'Successfully Added!');
    }

    public function manageImportantNotice()
    {
        return view('backend.cms.important_notice.index', [
            'important_notice' => ImportantNotice::orderBy('notice_title', 'asc')->get()
        ]);
    }

    public function editImportantNotice($id)
    {
        $important_notice = ImportantNotice::find($id);
        return view('backend.cms.important_notice.edit', [
            'important_notice' => $important_notice
        ]);
    }

    public function updateImportantNotice(Request $request)
    {
        $important_notice               = ImportantNotice::find($request->important_notice_id);
        $important_notice->notice_title = $request->notice_title;
        $important_notice->status = $request->status;
        $important_notice->save();
        return redirect(route('manage_important_notice'))->with('message', 'Successfully Updated!');
    }

    public function deleteImportantNotice(Request $request)
    {
        $important_notice = ImportantNotice::find($request->important_notice_id);
        $important_notice->delete();
        return redirect()->route('manage_important_notice')->with('message', 'Successfully Deleted!');
    }
}
