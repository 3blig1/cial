
@extends('vitrine.layouts.app')

@section('content')
   
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Courses</h2>
              <p>Découvrez nos cours d'allemand adaptés à tous les niveaux.</p>
            </div>
          </div>
        </div>
      </div> 
    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{ route('home') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Courses</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                @for ($i = 1; $i <= 6; $i++)

                 @php
                 $category = $i == 1 ? 'Niveau A1' : ($i == 2 ? 'Niveau A2' : ($i == 3 ? 'Niveau B1' : ($i == 4 ? 'Niveau B2' : ($i == 5 ? 'Niveau C1' : 'Cours Preparatifs aux examens'))));
                 @endphp
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                        <a href="#"><img src="{{ asset('vendors/images/course_' . $i . '.jpg') }}" alt="Image" class="img-fluid"></a>

                        <div class="category"><h3>{{ $category }}</h3></div>
                        </figure>
                        <div class="course-1-content pb-4">
                        <h2>
                            @switch($i)
                                @case(1)
                                    Allemand Niveau A1
                                    @break
                                @case(2)
                                    Allemand Niveau A2
                                    @break
                                @case(3)
                                    Allemand Niveau B1
                                    @break
                                @case(4)
                                    Allemand Niveau B2
                                    @break
                                @case(5)
                                    Allemand Niveau C1
                                    @break
                                @case(6)
                                    Cours préparatifs aux examens
                                    @break
                            @endswitch
                        </h2>
                        <div class="rating text-center mb-3">
                            @for ($star = 1; $star <= $i; $star++)
                                <span class="icon-star2 text-warning"></span>
                            @endfor
                        </div>
                        <p class="desc mb-4">
                            @switch($i)
                                @case(1)
                                    Ce niveau s'adresse aux débutants et permet d'acquérir les bases de la langue allemande : se présenter, comprendre et utiliser des expressions courantes.
                                    @break
                                @case(2)
                                    Approfondissement des connaissances de base, compréhension de phrases simples et capacité à communiquer dans des situations familières.
                                    @break
                                @case(3)
                                    Développement de l'autonomie à l'oral et à l'écrit, compréhension de textes simples et capacité à exprimer des opinions sur des sujets familiers.
                                    @break
                                @case(4)
                                    Maîtrise des structures complexes, compréhension de textes variés et capacité à interagir avec aisance dans la plupart des situations.
                                    @break
                                @case(5)
                                    Perfectionnement de la langue, compréhension de textes longs et exigeants, expression claire et structurée sur des sujets complexes.
                                    @break
                                @case(6)
                                    Préparation intensive aux examens officiels (ÖSD, Goethe), entraînement aux épreuves et acquisition des stratégies de réussite.
                                    @break
                            @endswitch
                        </p>
                        <p><a href="{{ route('contact') }}" class="btn btn-primary rounded-0 px-4">s'inscrire</a></p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

   

    @include('vitrine.layouts.footer')
@endsection
