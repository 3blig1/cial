@extends('vitrine.layouts.app')

@section('title', 'Qui sommes-nous ? | CIAL Sokodé')
@section('meta_description', 'Le CIAL est un centre d\'examen ÖSD accrédité basé à Sokodé. Découvrez notre mission, nos implantations et notre approche pédagogique.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/Proposition d´images/IMAGE2.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <h2 class="mb-0">Qui sommes-nous ?</h2>
                    <p>Fondé à Sokodé (Togo), le Centre Interculturel Allemand (CIAL) est un institut de formation linguistique et interculturelle dédié à l'enseignement de la langue allemande. Reconnu comme centre d'examen ÖSD accrédité depuis le 9 avril 2026, le CIAL constitue aujourd'hui un pôle d'excellence pour la certification en langue allemande dans la région.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Qui sommes-nous ?</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Notre mission</span></h2>
                    <p>Accompagner les apprenants dans leur parcours vers le monde germanophone - qu'il s'agisse d'études, d'un projet professionnel, d'une mobilité internationale ou d'une collaboration institutionnelle - en leur offrant une formation rigoureuse, certifiante et ancrée dans les réalités de l'Afrique de l'Ouest.</p>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('vendors/images/Proposition d´images/image etudiant en allemangne deja.jpeg') }}" alt="CIAL formation" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title-underline mb-4"><span>Ce que nous proposons</span></h2>
                    <ul class="ul-check primary list-unstyled">
                        <li>Des cours de langue allemande du niveau A1 au C1, en format intensif ou extensif.</li>
                        <li>Des sessions d'examens ÖSD certifiants, organisées régulièrement au siège de Sokodé et à l'antenne de Kara.</li>
                        <li>Des ateliers pratiques : culture allemande, système universitaire, vie professionnelle, démarches administratives.</li>
                        <li>Des modules de préparation à la mobilité internationale : rédaction de CV en allemand, préparation aux entretiens d'admission ou d'embauche.</li>
                        <li>Des parcours sur mesure pour entreprises et institutions : allemand professionnel, communication interculturelle, modules sectoriels (santé, technique, service public).</li>
                    </ul>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Notre approche pédagogique</span></h2>
                    <p>Notre méthode repose sur des techniques modernes, interactives et orientées vers la pratique réelle de la langue. Nous privilégions l'encadrement personnalisé, la progression par objectifs et la préparation concrète aux certifications officielles.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Nos implantations</span></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Élément</th>
                                    <th>Siège - Sokodé</th>
                                    <th>Antenne - Kara</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Adresse</td>
                                    <td>Komah 1, près du 23è BIR</td>
                                    <td>Quartier Dongoyo</td>
                                </tr>
                                <tr>
                                    <td>Statut</td>
                                    <td>Opérationnel</td>
                                    <td>Opérationnel</td>
                                </tr>
                                <tr>
                                    <td>Accréditation ÖSD</td>
                                    <td>Oui - depuis le 9 avril 2026</td>
                                    <td>Oui (extension du siège)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
