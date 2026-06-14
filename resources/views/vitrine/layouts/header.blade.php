<div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <div class="py-2 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 d-none d-lg-block">
            <a href="https://wa.me/22890333232" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Avez vous des questions?</a> 
            <a href="tel:+22890333232" class="small mr-3"><span class="icon-phone2 mr-2"></span> +228 90 33 32 32</a> 
            <a href="mailto:gf@cial-de.com" class="small mr-3"><span class="icon-envelope-o mr-2"></span> gf@cial-de.com</a> 
          <a href="https://www.facebook.com/share/1DKdTrmYaX/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" aria-label="Facebook CIAL"><span class="icon-facebook"></span></a>
          <a href="https://www.tiktok.com/@cial.togo" target="_blank" rel="noopener noreferrer" aria-label="TikTok CIAL"><span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" fill="currentColor" viewBox="0 0 15 20" aria-hidden="true"><path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/></svg></span></a>
          <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
        
          </div>
          <div class="">
       
      </div>
          <div class=" text-right">
            <a href="{{ route('examens-osd') }}" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-check"></span> Examens ÖSD</a>
          </div>
        </div>
      </div>
    </div>

<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
  <div class="container">
    <div class="d-flex align-items-center">
      <div class="site-logo">
        <a href="{{ url('/') }}" class="d-block">
          <img src="{{ asset('logo/Logo_cial.png') }}" width="200" alt="Logo CIAL" class="img-fluid">
        </a>
      </div>
      <div class="mr-auto">
        <nav class="site-navigation position-relative text-right" role="navigation">
          <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
              <a href="{{ route('home') }}" class="nav-link text-left">Accueil</a>
            </li>
            <li class="{{ request()->is('about') ? 'active' : '' }}">
              <a href="{{ route('about') }}" class="nav-link text-left">Qui sommes-nous ?</a>
            </li>
            <li class="{{ request()->is('courses') ? 'active' : '' }}">
              <a href="{{ route('courses') }}" class="nav-link text-left">Cours</a>
            </li>
            <li class="{{ request()->is('admissions') ? 'active' : '' }}">
              <a href="{{ route('admissions') }}" class="nav-link text-left">Admissions</a>
            </li>
            <li class="{{ request()->is('partenariats') ? 'active' : '' }}">
              <a href="{{ route('partenariats') }}" class="nav-link text-left">Partenariats</a>
            </li>
            <li class="{{ request()->is('contact') ? 'active' : '' }}">
                <a href="{{ route('contact') }}" class="nav-link text-left">Contact</a>
            </li>
          </ul>
        </nav>
      </div>
      
      <div class="site-logo">
        <a href="{{ url('/') }}" class="d-block">
          <img src="{{ asset('vendors/images/ösd/Logo ÖSD_final.png') }}" width="70" alt="Logo CIAL" class="img-fluid">
        </a>
      </div>
    </div>
  </div>
</header>
