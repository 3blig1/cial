@extends('vitrine.layouts.app')

@section('title', 'Examens ÖSD certifiants | CIAL Sokodé')
@section('meta_description', 'Passez votre certification ÖSD (A1 à C1) au CIAL, centre d\'examen accrédité au Togo. Sessions régulières à Sokodé. Inscription : gf@cial-de.com')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/Proposition d´images/CERTIFICATION.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-10">
                    <h2 class="mb-0">Centre d'examen ÖSD accrédité - Sokodé, Togo</h2>
                    <p>Certifiez votre niveau d'allemand avec une certification reconnue à l'international.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Examens ÖSD</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            @if(isset($upcomingExams) && $upcomingExams->count())
                @php($nextExam = $upcomingExams->first())
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="p-4 p-lg-5 bg-light border">
                            <div class="row align-items-center">
                                <div class="col-lg-8 mb-3 mb-lg-0">
                                    <span class="d-block text-uppercase text-primary font-weight-bold mb-2">Prochaine session ÖSD</span>
                                    <h2 class="h3 mb-2">{{ $nextExam->title }}</h2>
                                    <p class="mb-0">Date : <strong>{{ \Illuminate\Support\Carbon::parse($nextExam->exam_date)->format('d/m/Y') }}</strong></p>
                                    <p class="mb-0">{{ $nextExam->description ?: 'Session d\'examen publiée par l\'administration du CIAL.' }}</p>
                                </div>
                                <div class="col-lg-4 text-lg-right">
                                    <a href="mailto:gf@cial-de.com" class="btn btn-primary rounded-0 px-4 py-2 mr-2 mb-2">S'inscrire</a>
                                    <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-0 px-4 py-2 mb-2">Nous contacter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mb-5">
                <div class="col-lg-12">
                    <p>Le CIAL est un centre d'examen officiellement accrédité par l'ÖSD (Österreichisches Sprachdiplom Deutsch), l'une des trois grandes certifications de langue allemande reconnues à l'échelle internationale, aux côtés du Goethe-Zertifikat et du TestDaF. Cette accréditation confère au CIAL le statut de centre de référence pour la certification en langue allemande dans la région.</p>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Prochaines dates</span></h2>
                    @if(isset($upcomingExams) && $upcomingExams->count())
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingExams as $exam)
                                        <tr>
                                            <td>{{ \Illuminate\Support\Carbon::parse($exam->exam_date)->format('d/m/Y') }}</td>
                                            <td>{{ $exam->title }}</td>
                                            <td>{{ $exam->description ?: 'Session d\'examen ÖSD publiée par l\'administration.' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            Aucune prochaine date n'est encore publiée. Revenez bientôt ou contactez-nous au <a href="tel:+22890333232">+228 90 33 32 32</a> / <a href="mailto:gf@cial-de.com">gf@cial-de.com</a>.
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Examens disponibles</span></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Niveau</th>
                                    <th>Certification ÖSD</th>
                                    <th>Public cible</th>
                                    <th>Prix indicatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A1</td>
                                    <td>ÖSD Zertifikat Deutsch A1</td>
                                    <td>Visa familial, migration</td>
                                    <td><a href="https://examenosd.cial-de.com/exams">Consulter les prix</a></td>
                                </tr>
                                <tr>
                                    <td>A2</td>
                                    <td>ÖSD Zertifikat Deutsch A2</td>
                                    <td>Débutants avancés</td>
                                    <td><a href="https://examenosd.cial-de.com/exams">Consulter les prix</a></td>
                                </tr>
                                <tr>
                                    <td>B1</td>
                                    <td>ÖSD Zertifikat Deutsch B1</td>
                                    <td>Études, migration</td>
                                    <td><a href="https://examenosd.cial-de.com/exams">Consulter les prix</a></td>
                                </tr>
                                <tr>
                                    <td>B2</td>
                                    <td>ÖSD Zertifikat Deutsch B2</td>
                                    <td>Professionnels, études sup.</td>
                                    <td><a href="https://examenosd.cial-de.com/exams">Consulter les prix</a></td>
                                </tr>
                                <tr>
                                    <td>C1</td>
                                    <td>ÖSD Zertifikat Deutsch C1</td>
                                    <td>Niveau universitaire</td>
                                    <td><a href="https://examenosd.cial-de.com/exams">Consulter les prix</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title-underline mb-4"><span>Comment s'inscrire à un examen</span></h2>
                    <ul class="ul-check primary list-unstyled">
                        <li>Contactez-nous par téléphone au <a href="tel:+22890333232">+228 90 33 32 32</a> ou par email à <a href="mailto:gf@cial-de.com">gf@cial-de.com</a>.</li>
                        <li>Choisissez votre niveau et la session souhaitée.</li>
                        <li>Déposez les documents requis et réglez les frais d'inscription.</li>
                        <li>Recevez votre convocation et passez l'examen au CIAL.</li>
                        <li>Le certificat ÖSD officiel vous est remis après validation des résultats.</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title-underline mb-4"><span>Pourquoi l'ÖSD ?</span></h2>
                    <ul class="ul-check primary list-unstyled">
                        <li>Reconnu par les ambassades allemande, autrichienne et suisse pour les visas.</li>
                        <li>Accepté par les universités germanophones pour les admissions en licence et master.</li>
                        <li>Valide pour les dossiers de migration qualifiée (Fachkräfteeinwanderung).</li>
                        <li>Certification à durée illimitée, délivrée directement par l'ÖSD Vienne.</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>La plateforme dédiée est accessible à l'adresse : <strong>examenosd.cial-de.com</strong></p>
                    <p>
                        <a href="https://examenosd.cial-de.com" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-0 px-4 py-2">Accéder à la plateforme d'examen</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
