    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row main-footer">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="main-footer-info">
                        <img src="images/logo.png" alt="Logo" class="img-fluid">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam molestie malesuada
                            metus, non molestie ligula laoreet vitae. Ut et fringilla risus, vel.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-3 col-12">
                    <div class="main-footer-quicklinks">
                        <h6>Company</h6>
                        <ul class="quicklink">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="products.php">Shop</a></li>
                            <li><a href="cart.php">Cart</a></li>
                            <li><a href="my-wishlist.php">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright d-flex justify-content-between align-items-center">
                        <div class="copyright-text order-2 order-lg-1 w-100 text-center">
                            <p>&copy; 2022. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <script src="src/js/jquery.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/scss/vendors/plugin/js/slick.min.js"></script>
    <script src="src/scss/vendors/plugin/js/jquery.exzoom.js"></script>
    <script src="dist/main.js"></script>
    <script>
        function openNav() {

            document.getElementById("mySidenav").style.width = "350px";
            $('#overlayy').addClass("active");
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            $('#overlayy').removeClass("active");
        }
    </script>
    <script src="assets/js/tags.js"></script>
    <script>
        $('input[name="tags"]').amsifySuggestags({
          type : 'amsify'
        });
    </script>

    <!-- Toggle Password Show / Hide -->
    <script>
        $(document).ready(function() {
            $("#show-password").change(function(){
                $(this).prop("checked") ?  $("#upassword").prop("type", "text") : $("#upassword").prop("type", "password");    
            });
        });
    </script>

    <script src="assets/slider/assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/slider/owl-carousel/owl.carousel.min.js"></script>

    <script>
            
        $(document).ready(function($) {
          $("#owl-example").owlCarousel();
        });

    </script>

    <!-- $("body").data("page", "frontpage"); -->

    </script>
    <script src="assets/slider/assets/js/bootstrap-collapse.js"></script>
    <script src="assets/slider/assets/js/bootstrap-transition.js"></script>

    <script src="assets/slider/assets/js/google-code-prettify/prettify.js"></script>
      <script src="assets/slider/assets/js/application.js"></script>

    <script type="text/javascript">
        jQuery(function($){
          var disqus_loaded = false;
          var top = $("#faq").offset().top; 
          var owldomain = window.location.hostname.indexOf("owlgraphic");
          var comments = window.location.href.indexOf("comment");

          if(owldomain !== -1){
            function check(){
              if ( (!disqus_loaded && $(window).scrollTop() + $(window).height() > top) || (comments !== -1) ){
                $(window).off( "scroll" )
                disqus_loaded = true;
                /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                var disqus_shortname = 'owlcarousel'; // required: replace example with your forum shortname
                var disqus_identifier = 'OWL Carousel';
                //var disqus_url = 'http://owlgraphic.com/owlcarousel/';
                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
              }
            }
            $(window).on( "scroll", check )
            check();
          } else {
            $('.disqus').hide();
          }
        });
    </script>

    <script>
    var owldomain = window.location.hostname.indexOf("owlgraphic");
    if(owldomain !== -1){
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-41541058-1', 'owlgraphic.com');
      ga('send', 'pageview');
    }
    </script>

    <script>
        $(".galleryImage").click(function(){
            var url = $(this).attr('rel');
            $(".imgtochange").attr('src', '');
            $(".imgtochange").attr('src', url);
        });
    </script>
</body>