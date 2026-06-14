@extends('vitrine.layouts.app')

@section('title', 'Mentions légales | CIAL')
@section('meta_description', 'Consultez les informations légales du Centre Interculturel Allemand (CIAL), centre d\'examen ÖSD accrédité à Sokodé, Togo.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/Proposition d´images/IMAGE2.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <h2 class="mb-0">Mentions légales / Impressum</h2>
                    <p>Informations légales relatives au Centre Interculturel Allemand (CIAL).</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Mentions légales</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Dénomination sociale</th>
                                    <td>Centre Interculturel Allemand - CIAL</td>
                                </tr>
                                <tr>
                                    <th>Forme juridique</th>
                                    <td>Sarl U (Société à responsabilité limitée unipersonnelle)</td>
                                </tr>
                                <tr>
                                    <th>Siège social</th>
                                    <td>Sokodé, Komah 1, près du 23è BIR - Togo</td>
                                </tr>
                                <tr>
                                    <th>Directeur Général</th>
                                    <td>Yasser YOROU</td>
                                </tr>
                                <tr>
                                    <th>RCCM</th>
                                    <td>TG-SOK-01-2025-B13-00001</td>
                                </tr>
                                <tr>
                                    <th>NIF</th>
                                    <td>1001994527</td>
                                </tr>
                                <tr>
                                    <th>IBAN</th>
                                    <td>TG53TG1160101108624950010132</td>
                                </tr>
                                <tr>
                                    <th>Téléphone</th>
                                    <td><a href="tel:+22890333232">+228 90 33 32 32</a></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><a href="mailto:gf@cial-de.com">gf@cial-de.com</a></td>
                                </tr>
                                <tr>
                                    <th>Accréditation ÖSD</th>
                                    <td>Centre d'examen ÖSD accrédité - depuis le 9 avril 2026</td>
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
