@extends('backend.master')
@section('title')
CMS :: Preview Tender
@endsection
@section('content')
<style>
    .next-prev-btn-div,
    .num-btn-div {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    /* .card-body{
        height: 65vh;
        overflow-y: scroll;
    } */

    .card-body img {
        width: 300px;
    }

    .tender-head {
        display: flex;
        gap: 10px;
        justify-content: space-between;
    }

    .slider_buttons {
        padding: 10px 0px;
    }


    .single_img_div {
        position: relative;
        display: inline-block;
    }

    .download_btn {
        position: absolute;
        top: -68px;
        right: 0px;
        z-index: 10;
    }

    @media(max-width: 576px) {
        .app-content .side-app {
            padding: 0px !important;
        }

        .container-fluid {
            padding: 0px !important;
        }

        .card-body {
            padding-bottom: 0px !important;
            padding-top: 0px !important;
            /* height: 70vh;
            overflow-y: hidden; */
        }

        .slider_buttons {
            position: absolute;
            bottom: 150px;
            /* Adjust based on the footer's height */
            width: 100%;
            text-align: center;
            z-index: 1;
        }

        .download_btn {
            position: absolute;
            top: -48px;
            right: 0px;
            z-index: 10;
        }
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="card-header">
                    <div class="row" style="width: 100%;">
                        <div class="col-12 d-flex justify-content-center">
                            <h6 class="fw-bold">{{ $tender->subCategory->sub_category_name }}</h6>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <small> <strong>Posted On: </strong> {{ \Carbon\Carbon::parse($tender->created_at)->format('d F Y') }}</small>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <small> <strong>Tender Deadline:</strong> {{ \Carbon\Carbon::parse($tender->tender_validity)->format('d F Y') }}</small>
                        </div>
                        <div class="col-12 d-flex justify-content-start">
                            <button class="btn btn-dark btn-sm" onclick="history.back();"><i class="fa fa-reply"></i> Go Back</button>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="single_img_div">
                        @if ($tender->tender_image_one)
                        <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_one) }}" download="{{ $tender->tender_title }}_image1.jpg">Download</a>
                        <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_one) }}" alt="{{ $tender->tender_title }}" title="{{ $tender->tender_title }}">
                        @endif
                    </div>
                    <div class="single_img_div">
                        @if ($tender->tender_image_two)
                        <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_two) }}" download="{{ $tender->tender_title }}_image2.jpg">Download</a>
                        <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_two) }}" alt="{{ $tender->tender_title }}" title="{{ $tender->tender_title }}">
                        @endif
                    </div>
                    <div class="single_img_div">
                        @if ($tender->tender_image_three)
                        <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_three) }}" download="{{ $tender->tender_title }}_image3.jpg">Download</a>
                        <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_three) }}" alt="{{ $tender->tender_title }}" title="{{ $tender->tender_title }}">
                        @endif
                    </div>
                    <div class="single_img_div">
                        @if ($tender->tender_image_four)
                        <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_four) }}" download="{{ $tender->tender_title }}_image4.jpg">Download</a>
                        <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_four) }}" alt="{{ $tender->tender_title }}" title="{{ $tender->tender_title }}">
                        @endif
                    </div>
                    <div class="single_img_div">
                        @if ($tender->tender_image_five)
                        <a class="btn btn-sm btn-info-gradient download_btn" href="{{ asset($tender->tender_image_five) }}" download="{{ $tender->tender_title }}_image5.jpg">Download</a>
                        <img class="mySlides img-fluid" src="{{ asset($tender->tender_image_five) }}" alt="{{ $tender->tender_title }}" title="{{ $tender->tender_title }}">
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="slider_buttons bg-white">
    <div class="next-prev-btn-div">
        <button class="btn btn-danger-gradient prev-btn" onclick="plusDivs(-1)">❮ Prev</button>
        <button class="btn btn-danger-gradient next-btn" onclick="plusDivs(1)">Next ❯</button>
    </div>
    <div class="num-btn-div mt-2">
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
