<footer class="position-relative py-5">
    <div class="container-fluid w-80 pt-5">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-12 text-center text-lg-start">
                <a href=""><img alt="Sketch Iconic" class="lozad mb-3" data-src="assets/img/logo.png"></a>
                <p>We’re Passionate About Illustrations, Sketches And Everything That Requires A Creative Vision. –
                    We’ve Done It All.</p>
            </div>
            <div class="col-xl-9 col-lg-8 col-12 ">
                <div class="row justify-content-end">
                    <div class="col-md-6 col-xl-5">
                        <h5>Quick Links</h5>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled  mb-0">
                                    <li class="">
                                        <a href="./index.php">
                                            Home
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="./about.php">
                                            About
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="./process.php">
                                            Process
                                        </a>
                                    </li>


                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled  mb-0">

                                    <li class="">
                                        <a href="./portfolio.php">
                                            Portfolio
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./terms.php">Term of use</a>
                                    </li>
                                    <li>
                                        <a href="./privacy.php">Privacy Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-5">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled  mb-0">
                                    <li class="">
                                        <a href="tel:<?php echo $no;?>">
                                            <?php echo $no;?>
                                        </a>
                                    </li>
                                    <li class="">
                                    <a href="mailto:sales@sketchiconic.com">
                                            sales@sketchiconic.com
                                        </a>
                                    </li>
                                    <li class="">
                                    
                                            <?php echo $add;?>
                                        
                                    </li>


                                </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center col-12 text-center mt-lg-0 mt-3">
                <p class="m-0">
                    ©2022 Sketch Iconic All Rights Reserved.
                </p>
            </div>

        </div>

    </div>
</footer>
<!-- Get A quote modal start -->
<div class="modal fade " id="get-a-quote-modal" tabindex="-1" aria-labelledby="get-a-quote-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formbox text-white">
                    <h4 class="fw-900 f-30">Signup Now To Avail</h4>
                    <h2 class="fw-900 f-46	clr-1">50% Discount</h2>
                    <p>By Experienced And Professional Designers</p>

                    <form>
                        <div class="form-group mb-2 position-relative inputicon">

                            <input type="text" name="name_new" placeholder="Enter Your Name" class="form-control">
                        </div>
                        <div class="form-group mb-2 position-relative inputicon">

                            <input type="email" name="email_new" placeholder="Enter Your Email" class="form-control">
                        </div>
                        <div class="form-group mb-2 position-relative inputicon">

                            <input type="number" name="phone_new" placeholder="Enter Your Phone" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <textarea name="msg" placeholder="To help us understand better" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <a href="" class="w-100 btn subbtn">SUBMIT</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Get A quote modal end -->
<script src="assets/js/plugin.js"></script>

<script src="assets/js/gsap.min.js"></script>

<script src="assets/js/DrawSVGPlugin.min.js"></script>
<script src="assets/js/Draggable.min.js"></script>
<script src="assets/js/MotionPathPlugin.min.js"></script>
<script src="assets/js/MotionPathHelper.min.js"></script>
<script src="assets/js/ScrollToPlugin.min.js"></script>
<script src="assets/js/ScrollTrigger.min.js"></script>
<script src="assets/js/custom.js" async></script>

<script>
$('.subbtn').on("click", function() {
    event.preventDefault();
    var FinalUrl = 'leadshooter.php';
    var form = $(this).closest('form');
    $.ajax({
        url: FinalUrl,
        type: 'POST',
        data: form.serialize(),
        success: function(data) {
            if (data) {
                window.location = (data);
            }
        }
    });
});

$(".phone_new").keydown(function(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
</script>

</body>

</html>