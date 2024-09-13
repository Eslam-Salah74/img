@extends('layouts.app')
@section('content')
    
    <!--&--------------- Carousel Start -->
    <div class="container-fluid mx-0  carousel-ct position-relative  pt-5">
        <div class="row container-xxl mx-auto ">
            <div class="col-lg-5 pt-5 position-relative z-1">
                <h1 class="carosel-title ">
                    انترناشيونال مصر <br> الجديدة للسياحــة
                </h1>
                <h2 class="carousel-sub my-3">
                    سجل الآن وانضم إلى آلاف المسافرين <br>الذين يثقون بنا لتحقيق رحلتهم الروحانية </h2>

                <p class="carosel-desc">مع مصر الجديدة للسياحة، نقدم لك رحلات حج وعمرة كاملة تشمل الإقامة المريحة،
                    التنقل السهل، وخدمات الإرشاد الديني الموثوقة. استعد لتجربة روحانية مميزة تأخذك إلى أجواء الحرم بكل
                    سلاسة وراحة. </p>
                <!-- <p class="carousel-second-sub">انضم إلينا في رحلة العمر، واترك لنا كل ما قد يشغل بالك.</p> -->
                <a href="#register" class="register mt-4">احجز مكانك في رحلة العمر</a>
            </div>
        </div>
        <img src="{{asset('assets/img/bg/Subtract.png')}}" class="position-absolute bottom-0 start-0 end-0 w-100" alt="">
    </div>
    <!--&--------------- Carousel End -->

    <!--^--------------- Form start -->
    <div class="container-fluid register-ct px-lg-5 mb-4 bg-transparent d-flex justify-content-center align-items-center"
        id="register">
        <div class=" container register-sec-ct d-flex  mx-auto d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-center  position-relative">

                @if (session('error'))
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "{{ session('error') }}",
                            });
                        };
                    </script>
                @endif
                
                @if (session('success'))
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: "{{ session('success') }}",
                            });
                        };
                    </script>
                @endif

                <form id="registerForm" action="{{route('submitdata')}}" method="post" class="d-flex flex-column align-items-center  position-relative">
                    @csrf
                    <div class="d-flex flex-column w-100">
                        <h1 class="register-title ">
                            سجل الآن! </h1>

                        <h2 class="register-sub">
                            املأ البيانات التالية لتحجز مكانك في أحد برامج الحج أو العمرة المميزة.
                        </h2>

                    </div>
                    <div class="w-100">
                        <div class="radio-container d-md-flex flex-md-row flex-column  mb-3 ">
                            <p class="register-desc  mt-3">
                                بما الرحلة التي ترغب في حجزها - الحج أم العمرة؟</p>
                            <div class="radio-container z-1">
                                <label class="radio-label ">
                                    رحلات حج
                                    <input type="radio" name="trip" class="radio-input" checked>
                                    <span class="custom-radio "></span>
                                </label>
                                <label class="radio-label">
                                    رحلات عمرة
                                    <input type="radio" name="trip" class="radio-input">
                                    <span class="custom-radio checked"></span>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-3 phone-input-group z-2">

                            <input type="text" class="input-form-name  w-100" name="name" id="" placeholder="الاسم" required>

                            <select class="input-form custom-select" name="country_id" id="countrySelect" onchange="getCities(this.value)" required>
                                <option value="" disabled selected>الدولة</option>
                                @foreach ($coutries as $coutry)
                                    <option value="{{$coutry['id']}}">{{$coutry['name']}}</option>
                                @endforeach
                            </select>
                            <select class="input-form custom-select" name="city_id" id="citySelect" required>
                                <option value="" disabled selected>المدينة</option>
                            </select>

                            <input type="text" class="input-form phone-1 w-100" name="mobile" id="mobile"
                                placeholder="رقم الهاتف" required>
                            <input type="text" class="input-form phone-1 w-100" name="custom_attributes['mobile2']" id="mobile2"
                                placeholder="رقم هاتف آخر" id="mobile2">
                            <input type="hidden" class="input-form phone-1" name="primaryPhoneWithCode">
                            <input type="hidden" name="secondaryPhoneWithCode" id="secondaryPhoneWithCode">

                    
                            {{-- <select class="input-form custom-select" name="custom_attributes['level']" id="levelSelect" required>
                                <option value="">المستوى</option>
                                <option value="">المستوى</option>
                            </select> --}}
{{-- -in-form w-100 --}}
                            <div class="d-flex justify-content-center w-100">
                                <button type="button" onclick="validateAndSubmitForm()" class="register">انضم الينا! </button>
                            </div>
                        
                        </div>
                    </div>
                    <input type="hidden" name="activity_id" value="1" id="activity_id">
                </form>
            </div>
        </div>
    </div>
    <!--^--------------- Form End -->
    <div class="container-xxl divider my-5"></div>

    <!--?----------about Start -->
    <div class="container-xxl mt-5 mx-auto px-3" id="about-us">
        <div class=" about-ct"><span></span>
            <h1 class="register-title ">
                من نحن؟</h1>
            <p class="about-desc">
                مصر الجديدة للسياحة تقدم لكم سنوات من الخبرة والخدمات المميزة في مجال تنظيم رحلات الحج والعمرة.</p>
            <p class="about-desc-sub">
                متخصصون في الحج والعمرة ورحلات السياحة الداخلية في أجمل وأفضل المواقع السياحية المصرية وتنظيم الرحلات
                الجماعية والفردية الي أرقى المناطق السياحية في مصر و الي كل انحاء العالم، بالإضافة إلى الخدمات التالية:
            </p>

            <div class="row justify-content-between mt-5 pt-3 container-xxl mx-auto">
                <div class="col-md-2 col-6 ">
                    <div class=" about-card pt-4">
                        <img src="{{asset('assets/img/icons/ticket.svg')}}" alt="">
                        <p class="about-card-desc px-2 pt-3">
                            حجز تذاكر <br>الطيران
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-6 ">
                    <div class=" about-card pt-4">
                        <img src="{{asset('assets/img/icons/hotel.svg')}}" alt="">
                        <p class="about-card-desc px-2 pt-3">
                            حجز الفنادق </p>
                    </div>
                </div>


                <div class="col-md-2 col-6 ">
                    <div class=" about-card pt-4">
                        <img src="{{asset('assets/img/icons/train.svg')}}" alt="">
                        <p class="about-card-desc px-2 pt-3">
                            حجز تذاكر <br>القطارات
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-6 ">
                    <div class=" about-card pt-4">
                        <img src="{{asset('assets/img/icons/car.svg')}}" alt="">
                        <p class="about-card-desc px-2 pt-3">
                            النقل السياحي </p>
                    </div>
                </div>
                <div class="col-md-2 col-6 ">
                    <div class=" about-card pt-4">
                        <img src="{{asset('assets/img/icons/calendar.svg')}}" alt="">
                        <p class="about-card-desc px-2 pt-3">
                            تنظيم المؤتمرات والمعارض </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--?----------about End -->

    <div class="container-xxl divider my-5"></div>
    <!--* --------------Trips Start -->

    <section class="container-xxl mx-   text-center my-5  position-relative" id="team">
        <div class="discover-title-ct ">
            <h2 class="register-title ">
                من رحلاتنا </h2>

        </div>
        <div class="card__container swiper container-xxl">
            <div class="card__content">
                <div class="swiper-wrapper">
                    @if ($ourtrips->isNotEmpty())
                        @foreach ($ourtrips as $ourtrip)                                                               
                            <article class="card__article swiper-slide">
                                <div class="card__image">
                                    <div class="main-card card p-0 overflow-hidden ">
                                        <a href="seasonDetails.html"
                                            class="details overflow-hidden position-relative seasonDetails">
                                            <img src="{{asset('storage/'.$ourtrip->img)}}" alt="" class="w-100" />
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p>No Trips found.</p>
                    @endif
                </div>
            </div>

            <!-- Navigation buttons -->

            <!-- Pagination -->
            <!-- <div class="swiper-pagination" id="swiper"></div> -->
        </div>
        <div class="d-md-flex  d-none">
            <div class="swiper-button-next">
                <img src="{{asset('assets/img/icons/right.svg')}}" alt="">
            </div>

            <div class="swiper-button-prev">
                <img src="{{asset('assets/img/icons/left.svg')}}" alt="">
            </div>
        </div>

    </section>
    <!-- *=====================Trips End -->

    <div class="container-xxl divider my-5"></div>

    <!--&--------------- Form Start -->
    <section class="container-fluid position-relative" id="vid-ct">
        <div class="container-xxl mx-auto review-vid-ct d-md-flex justify-content-between">
            <div class="d-flex flex-column">
                <h2 class="register-title mt-5">اراء العملاء</h2>
                <p class="review-title">
                    اسمع من عملائنا الذين عاشوا <br> تجربة روحانية مميزة مع مصر <br> الجديدة للسياحة.
                </p>
            </div>
    
            @if($reviewVideo)
                <div class="d-flex video-ct">
                    <img class="video-pic" src="{{ asset('storage/' . $reviewVideo->thumbnail) }}" alt="">
                    <img class="vid-icon" src="{{ asset('assets/img/icons/vid.svg') }}" alt="">
                </div>
                <video src="{{ asset('storage/' . $reviewVideo->video) }}" class="d-none video-player" controls></video>
    
                <!-- Popup video container -->
                <div class="video-popup d-none">
                    <div class="popup-content">
                        <video class="popup-video" src="{{ asset('storage/' . $reviewVideo->video) }}" controls></video>
                    </div>
                </div>
            @else
                <div class="no-data-message">
                    <p>لا توجد بيانات</p>
                </div>
            @endif
    
        </div>
        <div class="blue-label position-absolute px-0 mx-0 start-0 end-0"></div>
    </section>
    
    
    <!--&--------------- Form End -->
    <!--~--------------- reviews Start -->
    <section class="container-xxl mx-auto h-100 d-flex flex-column mt-5">

        <div class="row reviews-ct-parent justify-content-lg-end gap-lg-4 gap-md-3 w-100 container-xxl mx-auto">
            @if ($customerReviews->isNotEmpty())
                @foreach ($customerReviews as $customerReview)                                                       
                    <div class="reviews-ct col-lg-3 col-md-3 py-3 ">
                        <div class="card-review-card">
                            <!-- عرض الصورة -->
                            <img class="avatar" src="{{ asset('storage/' . $customerReview->img) }}" alt="Review Image">
                            
                            <!-- عرض التقييم على شكل نجوم -->
                            <div class="d-flex justify-content-center">
                                @for ($i = 0; $i < $customerReview->rating; $i++)
                                    <svg width="20" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.0567 3.59676C12.3702 2.70613 13.6298 2.70613 13.9433 3.59676L15.6836 8.54082C15.8244 8.94104 16.2025 9.20879 16.6268 9.20879H22.0773C23.0653 9.20879 23.4548 10.489 22.6343 11.0393L18.3661 13.9018C17.9873 14.1559 17.8284 14.6341 17.9798 15.0643L19.6419 19.7863C19.9613 20.6937 18.9406 21.4847 18.1417 20.9489L13.557 17.8741C13.22 17.6482 12.78 17.6482 12.443 17.8741L7.85832 20.9489C7.05938 21.4847 6.03866 20.6937 6.35806 19.7863L8.02019 15.0643C8.17164 14.6341 8.01274 14.1559 7.63391 13.9018L3.36571 11.0393C2.54518 10.489 2.93472 9.20879 3.92271 9.20879H9.37317C9.79746 9.20879 10.1756 8.94104 10.3164 8.54082L12.0567 3.59676Z"
                                            fill="#D6B965" />
                                    </svg>
                                @endfor
                            </div>
                            
                            <!-- عرض المحتوى -->
                            <p class="review-content">{{ $customerReview->content }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No Reviews found.</p>
            @endif
        </div>
        
    </section>
    <!--~-------------- reviews End -->


{{-- Scrip Validation  --}}
<script>
    function validateAndSubmitForm() {
        const name = document.querySelector('input[name="name"]').value.trim();
        const mobile = document.querySelector('input[name="mobile"]').value.trim();
        const countrySelect = document.getElementById('countrySelect');
        const citySelect = document.getElementById('citySelect');
        if (!name || !mobile || countrySelect.selectedIndex === 0 || citySelect.selectedIndex === 0) {
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: 'الرجاء ملء جميع الحقول المطلوبة.',
            });
            return;
        }
    }
</script> 

{{-- Script Get Cities --}}

<script>
    function getCities(countryId) {
        const cityDropdown = $('#citySelect');

        if (countryId) {
            $.ajax({
                url: `/get-cities/${countryId}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    cityDropdown.empty().append('<option value="" disabled selected>أختر المدينة</option>');
                    
                    $.each(data.data, function (index, city) {
                        cityDropdown.append(`<option value="${city.id}">${city.name}</option>`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching cities:', error);
                }
            });
        } else {
            cityDropdown.empty().append('<option value="" disabled selected>لا توجد مدن</option>');
        }
    }
</script>

{{-- Script Radio Input --}}
<script>
    document.querySelectorAll('.radio-input').forEach(radio => {
        radio.addEventListener('change', function() {
            const hiddenInput = document.getElementById('activity_id');
            hiddenInput.value = this.value;
        });
    });
</script>

@endsection