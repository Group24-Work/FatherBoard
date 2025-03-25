<footer class="main-footer">
    <div class="footer-container">
        <div class="social-icons">
            {{-- <a href="https://facebook.com" target="_blank">
                <img src="images/front_images/facebook.png" alt="Facebook">
            </a>
            <a href="https://x.com" target="_blank">
                <img src="images/front_images/twitter.png" alt="Twitter">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="images/front_images/instagram.png" alt="Instagram">
            </a>
            <a href="https://linkedin.com" target="_blank">
                <img src="images/front_images/linkedin.png" alt="LinkedIn">
            </a> --}}
                    <img id="footer-icon" src="{{asset('images/FatherboardTransparentCrop.png')}}" id="logo" alt="FatherBoard Logo"
                width="100" height="50">
        </div> 

        <div id="footer-link">
            <a href="{{route("contact")}}">Contact Us</a>

            <a href="{{route("about")}}">About Us</a>
        </div>
        <p>&copy; 2024 FatherBoard. All Rights Reserved.</p>
    </div>
    </footer>