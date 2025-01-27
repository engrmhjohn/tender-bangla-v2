<!-- Contact Start -->
<style>
    .gradient h5 {
        border-bottom: 2px solid #fff;
        /* Green underline for title */
        display: inline-block;
        padding-bottom: 4px;
    }

    .important-links li {
        font-size: 16px;
        line-height: 1.5;
        border-bottom: 1px solid #fff;
    }

    .blank_space {
        display: block;
        margin-top: 45px;
    }

    @media (max-width: 576px) {
        .blank_space {
            margin-top: -40px;
        }
    }

</style>
<section id="contact" class="get-started">
    <div class="container">
        <!-- START THE CTA CONTENT  -->
        <div class="row text-white gradient radius-5 justify-content-center shadow">
            <div class="col-12 col-lg-6 shadow p-3">
                <h5 class="text-white fw-bold mb-3">{{ $homepage_cms->contact_header_text ?? 'Contact Info' }}</h5>
                <div class="information">
                    <i class="fas fa-home"></i>
                    <p>{{ $homepage_cms->office_address ?? 'Address Not Found' }}</p>
                </div>
                <div class="information">
                    <i class="fas fa-envelope"></i>
                    <p>{{ $homepage_cms->contact_email_one ?? 'Email 01' }}</p>
                </div>
                @if($homepage_cms->contact_email_two)
                <div class="information">
                    <i class="fas fa-envelope"></i>
                    <p>{{ $homepage_cms->contact_email_two ?? '' }}</p>
                </div>
                @endif
                <div class="information">
                    <i class="fas fa-phone-alt"></i>
                    <p>{{ $homepage_cms->contact_phone_one ?? 'Contact Number' }}</p>@if($homepage_cms->contact_phone_two)
                    ,<p>{{ $homepage_cms->contact_phone_two ?? '' }}</p>
                    @endif
                </div>
                <div class="pt-2 social_link">
                    <a target="_blank" class="btn btn-outline-light btn-social" href="{{ $homepage_cms->facebook_link ?? 'javascript:void(0)' }}"><i class="fab fa-facebook-f"></i></a>
                    <a target="_blank" class="btn btn-outline-light btn-social" href="https://wa.me/{{ $homepage_cms->whatsapp_number ?? 'javascript:void(0)' }}"><i class="fab fa-whatsapp"></i></a>
                    <a target="_blank" class="btn btn-outline-light btn-social" href="{{ $homepage_cms->youtube_link ?? 'javascript:void(0)' }}"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 justify-content-center align-items-center p-3">
                <div class="important-links rounded">
                    <h5 class="text-white fw-bold mb-3">গুরুত্বপূর্ণ লিংক</h5>
                    <ul class="list-unstyled">
                        @foreach ($helplines->take(6) as $helpline)
                        <li class="d-flex align-items-center mb-2">
                            <a class="text-white fw-bold" target="_blank" href="{{ $helpline->helpline_link }}">
                                <i class="bi bi-check-circle-fill text-white me-2"></i>
                                {{ $helpline->helpline_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 justify-content-center align-items-center p-3">
                <span class="blank_space"></span>
                <div class="important-links rounded">
                    <ul class="list-unstyled">
                        @foreach ($helplines->skip(6) as $helpline)
                        <li class="d-flex align-items-center mb-2">
                            <a class="text-white fw-bold" target="_blank" href="{{ $helpline->helpline_link }}">
                                <i class="bi bi-check-circle-fill text-white me-2"></i>
                                {{ $helpline->helpline_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact End -->
<footer class="footer bg-dark">
    <!-- START THE COPYRIGHT INFO  -->
    <div class="footer-bottom pt-2 pb-2">
        <div class="container">
            <div class="row text-center text-white">
                <div class="col-md-12 text-center mb-3 mb-md-0">
                    &copy; <a class="border-bottom text-secondary" href="{{ route('/') }}" id="copyright">Tender Bangla </a>
                    <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))

                    </script>
                    সমস্ত অধিকার সংরক্ষিত.
                </div>
            </div>
        </div>
    </div>
</footer>
