
<!-- ========================= Header Navbar Start====================== -->
      <!-- ------------- Second ------------- -->
      <div id="Secondtop_header" class="header">
        <nav class="navbar bg-body-tertiary">
            <div class="container">
              <a href="index.html"><img src="{{url('assets/img/logo.png')}}" style="width: 90px;"></a> 
                <form class="d-flex searchStore_input" role="search"> 
                  <div class="input-group">    
                    <input type="text" minlength="3" class="form-control d-flex" placeholder="Search store">
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button">
                        <i class="bi bi-search"></i>
                      </button>
                    </div>
                  </div> 
                </form>

                <div class="header_icon">
                  <a href="" class="me-2 text-reset">
                    <i class="fa-brands fa-facebook"></i>
                  </a>
                  <a href="" class="me-2 text-reset">
                    <i class="fab fa-twitter "></i>
                  </a>
                  <a href="" class="me-2 text-reset">
                    <i class="fab fa-instagram "></i>
                  </a>
                  <a href="" class="me-2 text-reset">
                    <i class="fab fa-youtube "></i>
                  </a>
                </div>
                
                <div class="d-flex">
				  <div class="me-2 mt-1">
					<a class="dropdown-item" href="{{route('switchLan','en')}}">English</a>
                    <a class="dropdown-item" href="{{route('switchLan','ar')}}">Arabic</a>
				  </div>
                    <div class="me-2 mt-1">
                      <a href="zakat.html" class="btn btn-secondary btn-sm zakatCalciBtn" >Zakat Calculator</a>
                    </div>
                    <div class="dropdown drop_cartBtn mt-0 me-2 user_icnBTN">
					@guest('web')
					   <button class="btn btn-secondary dropDownBtn dropdown-toggle" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-user"></i>
                      </button>
                    @else
				      <div class="me-2 mt-1">
                        <a class="dropdown-item" href="{{ route('logout',app()->getLocale()) }}">Logout</a>
                    </div>
				  @endguest
				  
                      <!-- Modal -->
                      <div class="modal right fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <p class="modal-title fs-6" id="exampleModalLabel"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  style="font-size: 11px;"></button></p>
                                  <h1 class="modal-title " id="exampleModalLabel" style="font-size: 18px;">My account</h1>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <h5 class="mt-4" style="font-size: 17px; font-weight: 600; color: #4d5154;">Sign in to use features services. / New Donor</h5>
                                  <div class="col-md-6 mt-2">
                                      <a href="{{route('login',app()->getLocale())}}" class="btn BTN-1 btn-sm w-100"><i class="fa-solid fa-shield-halved"></i> LOG IN</a>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                      <a href="{{route('register',app()->getLocale())}}" class="btn BTN-1 btn-sm w-100"><i class="fa-solid fa-user"></i> REGISTER</a>
                                  </div>
                                  <h5 class="mt-4 text-center" style="font-size: 15px; font-weight: 600; color: #4d5154; ">By creating an account on our website you will be able to shop faster, be up to date on an donations status, and keep track of the donations you have previously made.</h5>
                                </div>
                              </div>
                          </div>
                          </div>
                      </div>
                  </div>
                    <div class="dropdown drop_cartBtn mt-0">
                        <a href="cart.html" class="btn btn-secondary dropDownBtn dropdown-toggle">  <i class="fa-solid fa-basket-shopping"></i></a>
                    </div>
                </div>
            </div>
        </nav>
      </div>
       <!-- ------------- Third ------------- -->
      <div id="header" class="header">
        <nav class="navbar main-navB-1 navbar-expand-lg bg-body-tertiary">
            <div class="container ">
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
             
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active " aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="awqaf.html">Awqaf</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="projects.html">Our projects</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="sponsorship.html">Sponsorship</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="zakat.html"> Zakat</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="dedications.html">Dedications</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="requestyourproject.html">Request your project</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="requestyourproject.html">Small kid donor</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Who are we
                  </a>
                  <ul class="dropdown-menu">
                  <li><a class="dropdown-item " href="who-are-we.html">About Us</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item " href="news-reports.html">News and Reports</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item " href="achievements.html">Our Achievements</a></li>
                  </ul>
                </li>
                </ul>
                
            </div>
            </div>
        </nav>
      </div>
  <!-- ========================= Header Navbar End ======================= -->

  <!-- =================== Side wrapper donation start=============== -->
  <div id="fastDonate" class="fast-donation-wrapper" style="display: block;">
    <div class="dropend">
        <button class="btn btn-secondary dropdown-toggle BG" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="writing-mode: vertical-rl; text-orientation: mixed;">
                <p style="vertical-align: inherit;">
                  <p class=" mb-0 fw-bold" style="vertical-align: inherit;">Fast Donation</p>
                  <i class="fa-solid fa-caret-left"></i>
                </p>
            </span>
        </button>
        <form class="dropdown-menu p-3 text-center">
            <div class="mb-3">
              <select class="form-select field" aria-label="Default select example">
                <option selected>Select project</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control field" id="exampletext" placeholder="Donation Amount">
            </div>
            <button type="submit" class="btn btn-primary w-100 fast_donateBtn">Donate now</button>
        </form>
    </div>
  </div>
  <!-- =================== Side wrapper donation start=============== -->

        
