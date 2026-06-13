@extends('vitrine.layouts.app')

@section('title', 'CIAL - Centre d\'examen ÖSD | Sokodé, Togo')
@section('meta_description', 'Apprenez l\'allemand et passez vos examens ÖSD au CIAL, centre de référence pour la certification en langue allemande à Sokodé, Togo.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="hero-slide owl-carousel site-blocks-cover">
        <div class="intro-section" style="background-image: url('{{ asset('vendors/images/hero_1.jpg') }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                        <h1>Bienvenue au CIAL</h1>
                        <p class="lead text-white mb-4">Une langue. Une culture. Un avenir.</p>
                        <p>
                            <a href="{{ route('admissions') }}" class="btn btn-primary rounded-0 px-4 py-2 mr-2">S'inscrire</a>
                            <a href="{{ route('examens-osd') }}" class="btn btn-outline-light rounded-0 px-4 py-2">Passer un examen ÖSD</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6">
                    <h2 class="section-title-underline mb-3">
                        <span>Pourquoi choisir le CIAL ?</span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="feature-1 border h-100">
                        <div class="icon-wrapper">
                            <span class="flaticon-mortarboard text-white"></span>
                        </div>
                        <div class="feature-1-content">
                            <h2>Centre d'examen ÖSD accrédité</h2>
                            <p>Le CIAL est un centre d'examen officiellement accrédité par l'ÖSD (Österreichisches Sprachdiplom Deutsch), l'une des certifications de langue allemande les plus reconnues au monde. Nous organisons des sessions d'examens certifiants du niveau A1 au C1, acceptés par les universités, les ambassades et les employeurs dans l'espace germanophone.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="feature-1 border h-100">
                        <div class="icon-wrapper">
                            <span class="flaticon-school-material text-white"></span>
                        </div>
                        <div class="feature-1-content">
                            <h2>Formation de A1 à C1</h2>
                            <p>Nous proposons des cours en présentiel adaptés à tous les profils - débutants, professionnels, étudiants - dans des formats intensifs ou extensifs. Chaque parcours est conçu pour mener vers une certification officielle reconnue.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="feature-1 border h-100">
                        <div class="icon-wrapper">
                            <span class="flaticon-library text-white"></span>
                        </div>
                        <div class="feature-1-content">
                            <h2>Ouverture sur l'espace germanophone</h2>
                            <p>Études en Allemagne, formation professionnelle, migration qualifiée : le CIAL vous prépare concrètement aux démarches et aux exigences du monde germanophone - au-delà de la simple maîtrise de la langue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-bg style-1" style="background-image: url('{{ asset('vendors/images/hero_1.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <h2 class="section-title-underline style-2">
                        <span>C'est quoi le CIAL ?</span>
                    </h2>
                </div>
                <div class="col-lg-8">
                    <p class="lead">Le Centre Interculturel Allemand (CIAL) est un institut de formation spécialisé dans l'enseignement de la langue allemande et le développement des compétences interculturelles. Basé à Sokodé et disposant d'une antenne à Kara, le CIAL s'adresse à un public varié : étudiants, jeunes professionnels, entreprises et institutions souhaitant s'ouvrir à l'espace germanophone dans une perspective académique, professionnelle ou culturelle. Centre d'examen ÖSD accrédité depuis le 9 avril 2026, le CIAL est aujourd'hui un pôle de référence pour la certification en langue allemande dans le nord du Togo.</p>
                    <p><a href="{{ route('about') }}">En savoir plus</a></p>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
