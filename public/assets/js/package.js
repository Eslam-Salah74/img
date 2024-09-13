

window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.stickyUl');
    const navbarOffset = navbar.offsetTop;

    if (window.pageYOffset > navbarOffset) {
        navbar.classList.add('sticky');
        navbar.classList.add('py-2');
        navbar.classList.remove('mt-2');


    } else {
        navbar.classList.remove('sticky');
        navbar.classList.add('mt-2');

    }
});


document.addEventListener('DOMContentLoaded', function () {
    var dropdownMenu = document.querySelector('.dropdown-menu');
    var profileDropDown = document.querySelector('.profileDropDown');

    // Open/close dropdown menu when clicking on profileDropDown
    profileDropDown.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevents the document click listener from firing
        dropdownMenu.classList.toggle('show');
    });

    // Close dropdown menu when clicking outside of it
    document.addEventListener('click', function (event) {
        var isClickInsideDropdown = dropdownMenu.contains(event.target);
        var isClickOnProfileDropDown = profileDropDown.contains(event.target);

        if (!isClickInsideDropdown && !isClickOnProfileDropDown) {
            dropdownMenu.classList.remove('show');
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    var guideCt = document.querySelector('.guideCt');
    var scrollTrigger = 50; // Adjust this value based on when you want the class to be added

    window.addEventListener('scroll', function () {
        if (window.scrollY > scrollTrigger) {
            guideCt.classList.add('scrolled');
        } else {
            guideCt.classList.remove('scrolled');
        }
    });
});



// Add click event to all timeline items to toggle expanded class
document.querySelectorAll('.timeline-item').forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('expanded');
    });
});





window.addEventListener('scroll', function () {
    let sections = document.querySelectorAll('section'); // Get all sections with ids
    let scrollPosition = window.scrollY || document.documentElement.scrollTop;
    let carouselSection = document.getElementById('custCarousel');
    let carouselTop = carouselSection ? carouselSection.offsetTop : 0;
    let carouselHeight = carouselSection ? carouselSection.offsetHeight : 0;

    sections.forEach(section => {
        let sectionTop = section.offsetTop - 100; // Adjust for your specific case
        let sectionHeight = section.offsetHeight;

        // Check if the current scroll position is within the bounds of the section
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            // Remove active class from all links
            document.querySelectorAll('.guide-item').forEach(link => link.classList.remove('active'));

            // Add active class to the corresponding link
            let currentLink = document.querySelector(`.guide-item[href="#${section.id}"]`);
            if (currentLink) currentLink.classList.add('active');
        }
        // Check if we're within the bounds of the carousel section
        else if (scrollPosition >= carouselTop && scrollPosition < carouselTop + carouselHeight) {
            // Remove active class from all links when within the carousel section
            document.querySelectorAll('.guide-item').forEach(link => link.classList.remove('active'));
        }
    });
});



document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#datepicker", {
        // your options here
    });

    flatpickr("#another-datepicker", {
        // your options here
    });

    flatpickr("#another-datepicker-two", {
        // your options here
    });
});
function handleDateInput(event) {
    const inputId = event.target.id;

    if (inputId === 'datepicker') {
        // Handle datepicker input
    } else if (inputId === 'another-datepicker') {
        // Handle another datepicker input
    }
    else if (inputId === 'another-datepicker-two') {
        // Handle another datepicker input
    }
}




// Params
let mainSliderSelector = ".main-slider",
    navSliderSelector = ".nav-slider",
    interleaveOffset = 0.5;

// Main Slider
let mainSliderOptions = {
    loop: true,
    speed: 1000,
    autoplay: {
        delay: 3000
    },
    loopAdditionalSlides: 10,
    grabCursor: true,
    watchSlidesProgress: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    on: {
        init: function () {
            this.autoplay.stop();
        },
        imagesReady: function () {
            this.el.classList.remove("loading");
            this.autoplay.start();
        },
        slideChangeTransitionEnd: function () {
            let swiper = this,
                captions = swiper.el.querySelectorAll(".caption");
            for (let i = 0; i < captions.length; ++i) {
                captions[i].classList.remove("show");
            }
            swiper.slides[swiper.activeIndex]
                .querySelector(".caption")
                .classList.add("show");
        },
        progress: function () {
            let swiper = this;
            for (let i = 0; i < swiper.slides.length; i++) {
                let slideProgress = swiper.slides[i].progress,
                    innerOffset = swiper.width * interleaveOffset,
                    innerTranslate = slideProgress * innerOffset;

                swiper.slides[i].querySelector(".slide-bgimg").style.transform =
                    "translateX(" + innerTranslate + "px)";
            }
        },
        touchStart: function () {
            let swiper = this;
            for (let i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = "";
            }
        },
        setTransition: function (speed) {
            let swiper = this;
            for (let i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = speed + "ms";
                swiper.slides[i].querySelector(".slide-bgimg").style.transition =
                    speed + "ms";
            }
        }
    }
};
let mainSlider = new Swiper(mainSliderSelector, mainSliderOptions);

// Navigation Slider
let navSliderOptions = {
    loop: true,
    loopAdditionalSlides: 10,
    speed: 1000,
    spaceBetween: 5,
    slidesPerView: 5,
    centeredSlides: true,
    touchRatio: 0.2,
    slideToClickedSlide: true,
    direction: "vertical",
    on: {
        imagesReady: function () {
            this.el.classList.remove("loading");
        },
        click: function () {
            mainSlider.autoplay.stop();
        }
    }
};
let navSlider = new Swiper(navSliderSelector, navSliderOptions);

// Matching sliders
mainSlider.controller.control = navSlider;
navSlider.controller.control = mainSlider;




