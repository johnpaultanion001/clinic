<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ trans('panel.site_title') }}</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/landingpage.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="/"><img  src="img/logo.png" alt="" /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                  

                    <ul class="navbar-nav text-uppercase ml-auto">
             
                <li class="nav-item font-weight-bold enroll text-title"><a class="nav-link js-scroll-trigger" href="/register">Register Now</a></li>
                <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="#about">About Us</a></li>
                <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a></li>
        
                            @if (Auth::user())
                                <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="/admin/today">Dashboard</a></li>
                                 <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>                  
                            @else
                                <li class="nav-item font-weight-bold"><a class="nav-link js-scroll-trigger" href="/login">Sign in</a></li>
                            @endif

            </ul>



                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">

            <div class="container">
                <br>
                    <div class="row">
                        <div class="toptext">

                            <div class="col-md-12 ml-2 text-md-left">
                                <div style="font-size: 34px;" class="font-weight-bold text-dark"><b>Welcome to, {{ trans('panel.site_title') }}</b> </div>
                           </div>
                        </div>
                           
                    </div>

            </div>
        </header>
         <section class="page-section" id="about">
            <div class="container">
                    <h3 class="section-heading text-uppercase text-center mb-5 ">About Us</h3>
                    
                    <p class=" large font-weight-bold" style="font-size: 20px;">Vision:</p>

                
                    <li class="font-weight-normal large my-2" style="font-size: 18px;">A Preferred destination at the center of Calabarzon’s eastern growth corridor, with God – Cantered, Empowered and socially responsible citizenry living in sustainably- manage and safe environment having a globally competitive and progressive economy under an efficient and transparent leadership</li>
                    
                    <p class=" large font-weight-bold" style="font-size: 20px;">Mission:</p> 
                    <p class=" large font-weight-bold" style="font-size: 18px;">An efficient and transparent local government that is committed to the attainment of its vision and goals through: :</p>      
                    <li class="font-weight-normal large my-2" style="font-size: 18px;">1.	The creation of a favourable climate for local and foreign investor and tourists to ensure access to decent or quality job employment opportunities’ and stead revenue generation</li>
                    <li class="font-weight-normal large my-2" style="font-size: 18px;">2.	The protection, maintenance ,and rehabilitation of the physical environment;</li>
                    <li class="font-weight-normal large my-2" style="font-size: 18px;">3.	The maximum utilization of antipolo’s competitive and advantages:</li>
                    <li class="font-weight-normal large my-2" style="font-size: 18px;">4.	The development of a respectful, discipline, active, caring, and happy citizenry</li>
                    
                     <div class=" m-1 p-1">     
                    
                        <br>
                        <div class="text-center">
                        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger " href="/regiter">Regirster Now!</a>
                        </div>

                       
                    </div>

            </div>
        </section>

        

        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2 ">
                                                <i class="fas fa-phone  fa-2x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 class="card-title text-uppercase">0911-1111-111</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2 ">
                                                <i class="fas fa-envelope  fa-2x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <a href="mailto:test@test.com"  class="text-decoration-none text-dark"><h5 class="card-title text-uppercase">test@test.com</h5></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2 ">
                                                <i class="fab fa-facebook-f  fa-2x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <a href="https://www.facebook.com/HealthyPolo/"  target="_blank" class="text-decoration-none text-dark"><h5 class="card-title text-uppercase">HealthyPolo</h5></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.233175833772!2d121.17217201432008!3d14.585784881351204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397bf545b08c9e3%3A0xd718b05fd51e78a!2sCity%20Health%20Office!5e0!3m2!1sen!2sph!4v1615350865191!5m2!1sen!2sph" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
      
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-left">{{ trans('panel.site_title') }}@2021</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="/"><img  src="img/logo.png" alt=""  style="width:47px;" /></a>
                    </div>
                    <div class="col-lg-4 text-lg-right">

                     
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Bootstrap core JS-->
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/landingpage.js"></script>
    </body>
</html>
