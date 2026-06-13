@extends('vitrine.layouts.app')

@section('title', 'Admissions & Inscriptions | CIAL Togo')
@section('meta_description', 'Rejoignez le CIAL dès aujourd\'hui. Découvrez les conditions d\'admission, les documents requis et les modalités d\'inscription aux cours et examens.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <h2 class="mb-0">Admissions</h2>
                    <p>Procédure d'inscription aux formations et examens du CIAL.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Admissions</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <img src="{{ asset('vendors/images/course_6.jpg') }}" alt="Admissions CIAL" class="img-fluid">
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-4"><span>Conditions d'admission</span></h2>
                    <p>L'accès aux formations du CIAL est ouvert à toute personne souhaitant acquérir ou perfectionner ses compétences en langue allemande, quel que soit son niveau initial. Un test de positionnement gratuit est proposé à l'inscription pour orienter chaque participant vers le programme le plus adapté.</p>

                    <h5 class="mt-4">Documents requis pour l'inscription</h5>
                    <ol class="ul-check primary list-unstyled">
                        <li>Une copie d'une pièce d'identité (CNI, passeport ou tout document officiel).</li>
                        <li>Une copie du dernier diplôme ou attestation scolaire.</li>
                        <li>Une adresse e-mail fonctionnelle.</li>
                        <li>Une photo d'identité (format numérique ou physique).</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{ asset('vendors/images/course_3.jpg') }}" alt="Examens OSD" class="img-fluid">
                </div>
                <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                    <h2 class="section-title-underline mb-4"><span>Examens ÖSD</span></h2>
                    <p>Le CIAL est un centre d'examen officiellement accrédité par l'ÖSD (Österreichisches Sprachdiplom Deutsch - Diplôme autrichien de langue allemande). Cette accréditation est délivrée directement par l'ÖSD, organisation basée à Vienne, Autriche, et reconnue dans le monde entier.</p>

                    <p>Les certifications ÖSD sont acceptées par :</p>
                    <ul class="ul-check primary list-unstyled">
                        <li>Les ambassades d'Allemagne, d'Autriche et de Suisse pour les demandes de visa.</li>
                        <li>Les universités germanophones pour les admissions.</li>
                        <li>Les employeurs dans l'espace DACH (Allemagne, Autriche, Suisse).</li>
                        <li>Les offices de migration pour les dossiers de regroupement familial.</li>
                    </ul>

                    <p class="mb-1"><strong>Sessions d'examen :</strong> Les sessions sont organisées régulièrement à Sokodé.</p>
                    <p>Prochaines dates : nous contacter au <a href="tel:+22890333232">+228 90 33 32 32</a> ou par email à <a href="mailto:gf@cial-de.com">gf@cial-de.com</a>.</p>
                    <p><em>À compléter avec un calendrier précis dès confirmation des prochaines dates de session.</em></p>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
