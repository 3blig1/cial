@extends('vitrine.layouts.app')

@section('content')
    

    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">About Us</h2>
              <p>Nous sommes un institut de langue allemande basé à Sokodé, dédié à l'enseignement de la langue et à la promotion de la culture germanophone.</p>
            </div>
          </div>
        </div>
      </div> 
    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">About Us</span>
      </div>
    </div>

    <div class="container pt-5 mb-5">
            <div class="row">
              <div class="col-lg-4">
                <h2 class="section-title-underline">
                  <span>Academics History</span>
                </h2>
              </div>
              <div class="col-lg-4">
                <p>Le Centre Interculturel Allemand de Langues (CIAL) est un institut de formation basé à 
Sokodé, spécialisé dans l’enseignement de la langue allemande et le développement des 
compétences interculturelles.
</p>
              </div>
              <div class="col-lg-4">
                <p>Notre mission est d’accompagner les apprenants dans leur parcours vers le monde 
germanophone – que ce soit pour des études, un projet professionnel, une mobilité ou une 
collaboration internationale.</p>
              </div>
            </div>
          </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <img src="{{ asset('vendors/images/course_4.jpg') }}" alt="Image" class="img-fluid"> 
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>Ce que nous vous proposons</span>
                    </h2>
                    <p>En complément des cours de langue, le CIAL propose :
 Des ateliers pratiques : pour mieux comprendre la culture allemande, le fonctionnement 
des universités, la vie professionnelle ou encore les démarches administratives.
 
</p>
 <p>Des modules de préparation à la mobilité internationale : rédaction de CV et lettre de 
motivation en allemand, préparation aux entretiens d’admission ou d’embauche, etc. </p>
                    <p> Des parcours de formation sur mesure pour les entreprises et institutions : allemand 
professionnel, communication interculturelle, modules sectoriels (santé, technique, service 
public, etc.).</p>
                </div>
            </div>

            <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                        <img src="{{ asset('vendors/images/course_5.jpg') }}" alt="Image" class="img-fluid"> 
                    </div>
                    <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                        <h2 class="section-title-underline mb-5">
                            <span>Technique d'Appentissage</span>
                        </h2>
                        <p>Notre approche repose sur des méthodes modernes, interactives et orientées vers la 
pratique réelle de la langue. Nous mettons l’accent sur la qualité pédagogique, 
l’encadrement personnalisé et la construction de parcours cohérents vers des opportunités 
concrètes en Allemagne.</p>
                        <p>Le CIAL se positionne comme un acteur clé dans la formation linguistique et l’ouverture vers 
l’espace germanophone en Afrique de l’Ouest.</p>
                    </div>
                </div>
        </div>
    </div>

 

 
    <div class="site-section ftco-subscribe-1" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <h2>Subscribe to us!</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,</p>
          </div>
          <div class="col-lg-5">
            <form action="#" class="d-flex">
              <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
              <button class="btn btn-primary rounded py-3 px-4" type="submit">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div> 

    @include('vitrine.layouts.footer')
@endsection
