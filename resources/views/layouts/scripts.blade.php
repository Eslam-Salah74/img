<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

    <script>
        // Initialize the intlTelInput instances
        var input1 = document.querySelector("#mobile");
        var iti1 = window.intlTelInput(input1, {
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("us"));
            },
        });

        var input2 = document.querySelector("#mobile2");
        var iti2 = window.intlTelInput(input2, {
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("us"));
            },
        });

        // Handle form submission
        document.getElementById("phoneForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting

            // Get the full phone number with country code
            var phoneNumber1 = iti1.getNumber();
            var phoneNumber2 = iti2.getNumber();

            // Log the phone numbers
            console.log("Primary Phone Number:", phoneNumber1);
            console.log("Secondary Phone Number:", phoneNumber2);

            // You can now send this data to your server or perform other actions
        });
        $(document).ready(function () {
            $('#mySelect').select2({
                width: '100%', // Adjust the width as needed
                placeholder: "Select an option", // Placeholder text
                allowClear: true // Allows clearing of selection
            });
        });

    </script>


    <!-- JavaScript Libraries -->


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset('assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- Template Javascript -->
    <script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
    <!-- <script src="script.js"></script> -->
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>