@extends('backend.master')
@section('title')
CMS :: Preview Tender
@endsection
@section('content')
<style>
    .img_panel {
        position: relative;
    }

    .prev-btn,
    .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        padding: 6px 15px;
        cursor: pointer;
        z-index: 10;
    }

    .prev-btn {
        left: 10px;/
    }

    .next-btn {
        right: 10px;
    }


    .prev-btn:hover,
    .next-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }



    .tender-head {
        display: flex;
        gap: 10px;
        justify-content: space-between;
    }

    .download_btn {
        position: absolute;
        top: -73px;
        right: 0px;
        z-index: 10;
    }

    @media(max-width: 576px) {

        .prev-btn,
        .next-btn {
            position: static;
            display: inline-block;
            width: auto;
            margin: 5px; 
        }

        .next-prev-btn-div {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .download_btn {
            top: -49px;
        }

        .app-content .side-app {
            padding: 0px !important;
        }

        .container-fluid {
            padding: 0px !important;
        }

        .card-body {
            padding-bottom: 0px !important;
            padding-top: 0px !important;
        }
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-start">
                            <button class="btn btn-dark btn-sm" onclick="history.back();"><i class="fa fa-reply"></i> Go Back</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="img_panel d-flex justify-content-center position-relative">
                        <!-- Slider Images -->
                        <div class="single_img_div">
                            @if ($tender->tender_image_one)
                            <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_one) }}" download="{{ $tender->subCategory->sub_category_name }}_image1.jpg">Download</a>
                            <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_one) }}" alt="{{ $tender->subCategory->sub_category_name }}" title="{{ $tender->subCategory->sub_category_name }}">
                            @endif
                        </div>
                        <div class="single_img_div">
                            @if ($tender->tender_image_two)
                            <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_two) }}" download="{{ $tender->subCategory->sub_category_name }}_image2.jpg">Download</a>
                            <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_two) }}" alt="{{ $tender->subCategory->sub_category_name }}" title="{{ $tender->subCategory->sub_category_name }}">
                            @endif
                        </div>
                        <div class="single_img_div">
                            @if ($tender->tender_image_three)
                            <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_three) }}" download="{{ $tender->subCategory->sub_category_name }}_image3.jpg">Download</a>
                            <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_three) }}" alt="{{ $tender->subCategory->sub_category_name }}" title="{{ $tender->subCategory->sub_category_name }}">
                            @endif
                        </div>
                        <div class="single_img_div">
                            @if ($tender->tender_image_four)
                            <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_four) }}" download="{{ $tender->subCategory->sub_category_name }}_image4.jpg">Download</a>
                            <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_four) }}" alt="{{ $tender->subCategory->sub_category_name }}" title="{{ $tender->subCategory->sub_category_name }}">
                            @endif
                        </div>
                        <div class="single_img_div">
                            @if ($tender->tender_image_five)
                            <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_five) }}" download="{{ $tender->subCategory->sub_category_name }}_image5.jpg">Download</a>
                            <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_five) }}" alt="{{ $tender->subCategory->sub_category_name }}" title="{{ $tender->subCategory->sub_category_name }}">
                            @endif
                        </div>
                    </div>
                    <!-- Navigation Buttons -->
                    <div class="next-prev-btn-div">
                        <button class="btn btn-danger-gradient prev-btn" onclick="plusDivs(-1)">❮ Prev</button>
                        <button class="btn btn-danger-gradient next-btn" onclick="plusDivs(1)">Next ❯</button>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="slider_buttons bg-white">
                        <div class="num-btn-div">
                            @if ($tender->tender_image_one)
                            <button class="btn btn-outline-danger num-control" onclick="currentDiv(1)">1</button>
                            @endif
                            @if ($tender->tender_image_two)
                            <button class="btn btn-outline-danger num-control" onclick="currentDiv(2)">2</button>
                            @endif
                            @if ($tender->tender_image_three)
                            <button class="btn btn-outline-danger num-control" onclick="currentDiv(3)">3</button>
                            @endif
                            @if ($tender->tender_image_four)
                            <button class="btn btn-outline-danger num-control" onclick="currentDiv(4)">4</button>
                            @endif
                            @if ($tender->tender_image_five)
                            <button class="btn btn-outline-danger num-control" onclick="currentDiv(5)">5</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-2">
    <div class="card">
        <div class="card-header justify-content-center">
            <h3>More Information About <strong>{{ $tender->subCategory->sub_category_name }}</strong></h3>
        </div>
        <div class="row" style="width: 100%;">
            <div class="col-12 d-flex justify-content-center">
                <h6 class="fw-bold">Title: {{ $tender->subCategory->sub_category_name }}</h6>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <small> <strong>Posted On: </strong> {{ \Carbon\Carbon::parse($tender->created_at)->format('d F Y') }}</small>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <small> <strong>Tender Deadline:</strong> {{ \Carbon\Carbon::parse($tender->tender_validity)->format('d F Y') }}</small>
            </div>
        </div>
    </div>
</div>
<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("num-control");
        var downloadBtns = document.getElementsByClassName("download_btn"); // Get all download buttons

        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }

        // Hide all slides and download buttons
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            if (downloadBtns[i]) {
                downloadBtns[i].style.display = "none"; // Hide the download button
            }
        }

        // Remove active class from all numeric buttons
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" btn-danger", " btn-outline-danger");
        }

        // Display the current slide
        slides[slideIndex - 1].style.display = "block";

        // Display the current download button (if available)
        if (downloadBtns[slideIndex - 1]) {
            downloadBtns[slideIndex - 1].style.display = "block"; // Show the current download button
        }

        // Add active class to the current dot
        dots[slideIndex - 1].className = dots[slideIndex - 1].className.replace(" btn-outline-danger", " btn-danger");
    }

</script>
@endsection
