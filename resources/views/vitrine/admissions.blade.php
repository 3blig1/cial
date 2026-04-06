
@extends('vitrine.layouts.app')

@section('content')
    

    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Admissions</h2>
              <p>les documents nécessaires pour l'admission</p>
            </div>
          </div>
        </div>
      </div> 
    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Admission</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <img src="{{ asset('vendors/images/course_6.jpg') }}" alt="Image" class="img-fluid"> 
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>Conditions d'Admission</span>
                     </span>
                    </h2>
                    <p>L’accès à nos formations est ouvert à toute personne souhaitant acquérir ou perfectionner ses compétences en langue allemande, quel que soit son niveau initial.

</p>
                    <p>Selon le programme choisi (cours intensif, extensif ou préparation aux examens), un test de positionnement peut être proposé afin d’orienter le participant vers le niveau le plus adapté à ses besoins.
</p>

                    <ol class="ul-check primary list-unstyled">
                        <li>Une copie de la carte d’identité</li>
                        <li>Une copie du dernier diplôme </li>
                        <li>Une adresse e-mail fonctionnante.</li>
                        <li>Une photo Passport (Digital ou Physique)</li>
                    </ol>

                </div>
            </div>

            <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                        <img src="{{ asset('vendors/images/course_3.jpg') }}" alt="Image" class="img-fluid"> 
                    </div>
                    <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                        <h2 class="section-title-underline mb-5">
                            <span>Examens</span>
                        </h2>
                        <p>Nous préparons nos apprenants aux certifications linguistiques les plus reconnues au niveau international, notamment les examens ÖSD et Goethe-Zertifikat, du niveau A1 au niveau C1.</p>
                        <p>Les sessions d’examen sont organisées à intervalles réguliers, en collaboration avec nos partenaires accrédités.
Chaque formation inclut des simulations d’épreuves, un accompagnement personnalisé et des outils pédagogiques conçus pour maximiser les chances de réussite.</p>
                       
                    </div>
                </div>
        </div>
    </div>

    
    @include('vitrine.layouts.footer')
@endsection
