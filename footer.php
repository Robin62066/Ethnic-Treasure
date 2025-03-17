<footer>


    <div class="back mt-5" style="background-color: #D0808D;  ">
        <div class="container ">
            <div class="row">
                <div class="col-md-4 mt-5">
                    <div class="company">
                        <img src="<?= base_url() ?>image/logo1.png" class="rounded-2" alt="" height="100px" width="150px">
                        <p>The company works with a network of over 40 artisans across the country and is
                            committed to promoting sustainable and fair trade practices. In addition to its
                            brick-and-mortar stores.</p>

                        <p>Fabindia has an online presence and ships its products globally.
                            The company has grown to become one of the leading names in the Indian retail industry,
                            with over 300 stores across the country and internationally.</p>
                    </div>
                </div>
                <div class="col-md-4 mt-5  ">
                    <div class="link mt-5">
                        <div class="foot">
                            Quick Link
                        </div>
                        <li>
                            <a href="<?= base_url(); ?>">Home <i class="fa fa-hand-o-left icon" aria-hidden="true"></i></a>
                            <div class="line"></div>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>about.php">About <i class="fa fa-hand-o-left icon" aria-hidden="true"></i></a>
                            <div class="line"></div>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>product.php">Shop <i class="fa fa-hand-o-left icon" aria-hidden="true"></i></a>
                            <div class="line"></div>
                        </li>

                        <li>
                            <a href="<?= base_url() ?>contact.php">Contact <i class="fa fa-hand-o-left icon" aria-hidden="true"></i></a>
                            <div class="line"></div>
                        </li>

                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="Follow mt-5">
                        <div class="foot">
                            Newsletter
                        </div>
                        <div class="get  mt-4 ">
                            <label>Email Address : -</label>

                            <div class="get1 d-flex justify-content-between">
                                <input type="email" name="email" placeholder="Enter your email">
                                <button type="submit" class="btn btn-warning ">Subscribe</button>
                            </div>
                        </div><br>

                        <a href="#" class="fa fa-facebook "></a>
                        <a href="#" class="fa fa-instagram"></a>
                        <a href="#" class="fa fa-pinterest"></a>
                        <a href="#" class="fa fa-youtube"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 px-0" style=" background-color: #D0808D; padding: 10px;">
        <hr>
        <div class="copy text-center text-white">
            <p>Copyright 2025 All Right Reserved</p>
        </div>
    </div>
</footer>


<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                document.getElementById('navbar_top').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            }
        });
    });


    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 50,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>

</html>