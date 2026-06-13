@extends('vitrine.layouts.app')

@section('title', 'Cours d\'allemand A1 à C1 | CIAL Togo')
@section('meta_description', 'Des cours d\'allemand pour tous les niveaux à Sokodé et Kara. Formez-vous avec des enseignants qualifiés et préparez votre certification ÖSD.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">Cours</h2>
                    <p>Des parcours clairs du niveau A1 au C1 avec objectif de certification.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Cours</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            @php
                $courses = [
                    [
                        'level' => 'A1',
                        'title' => 'Allemand niveau A1',
                        'description' => 'Bases : se présenter, expressions courantes.',
                        'duration' => '~60h',
                        'exam' => 'ÖSD Zertifikat Deutsch A1',
                        'image' => 'course_1.jpg',
                    ],
                    [
                        'level' => 'A2',
                        'title' => 'Allemand niveau A2',
                        'description' => 'Communication dans des situations familières.',
                        'duration' => '~80h',
                        'exam' => 'ÖSD Zertifikat Deutsch A2',
                        'image' => 'course_2.jpg',
                    ],
                    [
                        'level' => 'B1',
                        'title' => 'Allemand niveau B1',
                        'description' => 'Autonomie à l\'oral et à l\'écrit, opinions.',
                        'duration' => '~100h',
                        'exam' => 'ÖSD Zertifikat Deutsch B1',
                        'image' => 'course_3.jpg',
                    ],
                    [
                        'level' => 'B2',
                        'title' => 'Allemand niveau B2',
                        'description' => 'Structures complexes, aisance.',
                        'duration' => '~120h',
                        'exam' => 'ÖSD Zertifikat Deutsch B2',
                        'image' => 'course_4.jpg',
                    ],
                    [
                        'level' => 'C1',
                        'title' => 'Allemand niveau C1',
                        'description' => 'Expression fluide, textes exigeants.',
                        'duration' => '~140h',
                        'exam' => 'ÖSD Zertifikat Deutsch C1',
                        'image' => 'course_5.jpg',
                    ],
                    [
                        'level' => 'Prépa examens',
                        'title' => 'Préparation intensive ÖSD',
                        'description' => 'Entraînement intensif aux épreuves ÖSD.',
                        'duration' => '~40h',
                        'exam' => 'Tous niveaux ÖSD',
                        'image' => 'course_6.jpg',
                    ],
                ];
            @endphp

            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="course-1-item h-100">
                            <figure class="thumnail">
                                <a href="#"><img src="{{ asset('vendors/images/' . $course['image']) }}" alt="{{ $course['title'] }}" class="img-fluid"></a>
                                <div class="category"><h3>{{ $course['level'] }}</h3></div>
                            </figure>
                            <div class="course-1-content pb-4">
                                <h2>{{ $course['title'] }}</h2>
                                <p class="desc mb-3">{{ $course['description'] }}</p>
                                <p class="mb-1"><strong>Durée indicative :</strong> {{ $course['duration'] }}</p>
                                <p class="mb-4"><strong>Débouché examen :</strong> {{ $course['exam'] }}</p>
                                <p><a href="{{ route('admissions') }}" class="btn btn-primary rounded-0 px-4">S'inscrire</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <p><em>Les durées indiquées sont des estimations. Elles peuvent être ajustées selon les programmes pédagogiques validés par la direction.</em></p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Cours d'allemand en ligne</span></h2>
                    <p>Le CIAL propose également des formations en allemand à distance, adaptées aux professionnels et aux entreprises souhaitant intégrer la langue allemande dans leur activité. Ces cours sont accessibles depuis n'importe où et peuvent être organisés en sessions individuelles ou en groupe.</p>
                    <ul class="ul-check primary list-unstyled">
                        <li>Format : visioconférence (Zoom / Google Meet)</li>
                        <li>Niveaux disponibles : A1 à B2</li>
                        <li>Programmes sur mesure pour entreprises</li>
                        <li>Contact : <a href="mailto:gf@cial-de.com">gf@cial-de.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
