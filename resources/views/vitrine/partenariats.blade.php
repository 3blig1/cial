@extends('vitrine.layouts.app')

@section('title', 'Partenariats institutionnels | CIAL')
@section('meta_description', 'Le CIAL collabore avec des universités, des institutions publiques et des partenaires internationaux. Découvrez nos conventions et opportunités de partenariat.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-10">
                    <h2 class="mb-0">Collaborations & Partenariats institutionnels</h2>
                    <p>Construisons ensemble des projets à impact autour de la langue allemande et de la mobilité internationale.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Partenariats</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <p>Le CIAL est ouvert à toute forme de collaboration institutionnelle avec des organismes publics, des universités, des entreprises et des organisations de la société civile, tant au niveau national qu'international. Notre accréditation ÖSD et notre ancrage dans le nord du Togo font du CIAL un partenaire de choix pour tout projet lié à la langue allemande et à la mobilité internationale en Afrique de l'Ouest.</p>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title-underline mb-4"><span>Partenariats actifs</span></h2>
                    <ul class="ul-check primary list-unstyled">
                        <li>Université de Kara - Convention de partenariat académique</li>
                        <li>Direction Régionale de l'Éducation Nationale - Convention de collaboration</li>
                        <li>ÖSD (Österreichisches Sprachdiplom Deutsch) - Accréditation officielle depuis le 9 avril 2026</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title-underline mb-4"><span>Partenariats en cours de développement</span></h2>
                    <ul class="ul-check primary list-unstyled">
                        <li>Ambassade d'Allemagne au Togo</li>
                        <li>DAAD (Office Allemand d'Échanges Universitaires)</li>
                        <li>Associations de la diaspora togolaise en Allemagne</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Vous souhaitez collaborer avec le CIAL ?</span></h2>
                    <p>Contactez-nous : <a href="mailto:gf@cial-de.com">gf@cial-de.com</a> | <a href="tel:+22890333232">+228 90 33 32 32</a></p>
                    <p><em>Ajouter les logos des partenaires officiels (ÖSD, Université de Kara) dès que disponibles.</em></p>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
