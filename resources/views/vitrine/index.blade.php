@extends('vitrine.layouts.app')

@section('title', 'Accueil - CIAL Centre Interculturel Allemand')

@push('head')
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/Logo_icone.png') }}?v=3">
<link rel="shortcut icon" href="{{ asset('logo/Logo_icone.png') }}?v=3">
@endpush

@section('content')
    
    @include('vitrine.layouts.header')

    
    <div class="hero-slide owl-carousel site-blocks-cover">
      <div class="intro-section" style="background-image: url('{{asset('vendors/images/hero_1.jpg')}}');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>Bienvenue au CIAL</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="intro-section" style="background-image: url('{{asset('vendors/images/hero_1.jpg')}}');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>Une langue, une culture, un avenir.</h1>
            </div>
          </div>
        </div>
      </div>

    </div>
    

    <div></div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Pourquoi choisir CIAL? </span>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

            <div class="feature-1 border">
              <div class="icon-wrapper">
                <span class="flaticon-mortarboard text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Diplome et Certificat</h2>
                <p>Nous assurons une préparation rigoureuse aux examens de certification reconnue 
internationalement, notamment les diplômes </p>
                <button id="btn-certificat" class="btn btn-primary px-4 rounded-0" type="button" data-toggle="collapse" data-target="#collapse-certificat" aria-expanded="false" aria-controls="collapse-certificat">Lire plus</button>
                <div class="collapse mt-2" id="collapse-certificat">
                  <p> ÖSD (Österreichisches Sprachdiplom Deutsch) et Goethe-Zertifikat,indispensables pour les études, le travail ou la migration vers l’Allemagne.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper">
                <span class="flaticon-school-material text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2> Formation et Preparation</h2>
                <p>Nous proposons plusieurs formats adaptés à tous les profils du niveau A1 au C1, ces cours permettent d’acquérir et de renforcer les compétences </p>
                <button id="btn-preparation" class="btn btn-primary px-4 rounded-0" type="button" data-toggle="collapse" data-target="#collapse-preparation" aria-expanded="false" aria-controls="collapse-preparation">Lire plus</button>
                <div class="collapse mt-2" id="collapse-preparation">
                  <p> fondamentales en compréhension pour vous préparez aux examens ÖSD et Goethe avec des enseignants formés et du matériel authentique.</p>
                </div>
              </div>
            </div> 
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper">
                <span class="flaticon-library text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Étudier ou travailler en Allemagne</h2>
                <p>L’Allemagne offre chaque année des milliers d’opportunités aux étudiants, professionnels et 
jeunes talents du monde entier.</p>
                <button id="btn-allemagne" class="btn btn-primary px-4 rounded-0" type="button" data-toggle="collapse" data-target="#collapse-allemagne" aria-expanded="false" aria-controls="collapse-allemagne">Lire plus</button>
                <div class="collapse mt-2" id="collapse-allemagne">
                  <p>Étudier dans une université allemande, intégrer une formation professionnelle ou saisir un emploi qualifié : tout cela est possible… à condition d’être bien préparé.</p>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>


   

    


    <div class="section-bg style-1" style="background-image: url('images/about_1.html');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="section-title-underline style-2">
              <span>C'EST QUOI LE CIAL?</span>
            </h2>
          </div>
          <div class="col-lg-8">
            <p class="lead">Le Centre Interculturel Allemand CIAL est un institut de formation spécialisé dans 
                l’enseignement de la langue allemande et le développement des compétences 
                interculturelles.</p>
            <p>
              Basé à Sokodé, il s’adresse à un public varié : étudiants, jeunes professionnels, entreprises 
              et institutions désireux de s’ouvrir à l’espace germanophone dans une perspective 
              académique, professionnelle ou culturelle.</p>
            <p><a href="#">Read more</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- // 05 - Block -->
  

    <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Notre philosophie</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Principes académiques</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Clé du succès</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="news-updates">
      <div class="container">
         
        <div class="row">
          <div class="col-lg-9">
             <div class="section-heading">
              <h2 class="text-black">Actualités &amp; Mises à jour</h2>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="post-entry-big">
                  <a href="news-single.html" class="img-link"><img src="{{asset('vendors/images/blog_large_1.jpg')}}" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta"> 
                      <a href="#">June 6, 2025</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="{{route('admissions')}}">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="news-single.html" class="img-link mr-4"><img src="{{asset('vendors/images/blog_1.jpg')}}" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">June 6, 2019</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>

                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="" class="img-link mr-4"><img src="{{asset('vendors/images/blog_2.jpg')}}" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">June 6, 2025</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="news-single.html">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>

                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="#" class="img-link mr-4"><img src="{{asset('vendors/images/blog_1.jpg')}}" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">June 6, 2025</a>
                      <span class="mx-1">/</span>
                      <a href="#">Admission</a>, <a href="#">Updates</a>
                    </div>
                    <h3 class="post-heading"><a href="#">Campus Camping and Learning Session</a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-heading">
              <h2 class="text-black">Campus Videos</h2>
              
            </div>
            <a href="#" class="video-1 mb-4" data-fancybox="" data-ratio="2">
              <span class="play">
                <span class="icon-play"></span>
              </span>
              <img src="{{asset('vendors/images/course_5.jpg')}}" alt="Image" class="img-fluid">
            </a>
            <a href="#" class="video-1 mb-4" data-fancybox="" data-ratio="2">
                <span class="play">
                  <span class="icon-play"></span>
                </span>
                <img src="{{asset('vendors/images/course_5.jpg')}}" alt="Image" class="img-fluid">
              </a>
          </div>
        </div>
      </div>
    </div>

   


    @include('vitrine.layouts.footer')
  </div>
  <!-- .site-wrap -->
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var toggles = [
    {btn: 'collapse-certificat', id: 'btn-certificat'},
    {btn: 'collapse-preparation', id: 'btn-preparation'},
    {btn: 'collapse-allemagne', id: 'btn-allemagne'}
  ];
  toggles.forEach(function(item) {
    var btn = document.getElementById(item.id);
    var collapse = document.getElementById(item.btn);
    if(btn && collapse) {
      collapse.addEventListener('show.bs.collapse', function() {
        btn.textContent = 'Lire moins';
      });
      collapse.addEventListener('hide.bs.collapse', function() {
        btn.textContent = 'Lire plus';
      });
    }
  });
});
</script>
@endpush

</html>