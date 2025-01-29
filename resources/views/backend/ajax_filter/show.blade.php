<style>
    .search_card .card-header {
        padding: 0px !important;
    }

    .search_card .card-body {
        padding: 0px 10px !important;
    }

    .tender-img {
        height: 60px;
        width: 60px;
        border-radius: 3px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .35);
    }
</style>
@foreach($tender_list as $tender)
<div class="col-lg-6 col-12 mt-3">
    <div class="card tender_card search_card sub-category-section">
        <div class="card-header d-flex justify-content-center">
            <h6>{{ $tender->subCategory->sub_category_name }}</h6>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-9">
                    <a href="{{ route('preview_tender', $tender->id) }}" class="tender-link">
                        <i class="fa fa-file-image-o"></i> {{ $tender->link_name }} <br>
                        @if($tender->tender_validity < now())
                        <span class="text-warning fw-bold">(Expired)</span>
                        @endif
                        @if($tender->created_at >= now()->subDays(3))
                        <img src="{{ asset('frontendAssets') }}/images/new_flashing.gif" alt="New">
                        @endif
                    </a>
                </div>
                <div class="col-3">
                    <a class="tender_logo" href="{{ route('preview_tender', $tender->id) }}">
                        <img src="{{ asset($tender->subCategory->logo) }}" alt="Logo" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
