@extends('vitrine.layouts.app')

@section('title', 'Contact | CIAL - Sokodé & Kara, Togo')
@section('meta_description', 'Contactez le Centre Interculturel Allemand : +228 90 33 32 32 | gf@cial-de.com. Siège à Sokodé, antenne à Kara.')

@section('content')
    @include('vitrine.layouts.header')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <h2 class="mb-0">Contact</h2>
                    <p>Nous sommes disponibles pour vos demandes d'inscription, d'examens ÖSD et de partenariats.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Contact</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="section-title-underline mb-4"><span>Nos coordonnées</span></h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><strong>Adresse siège :</strong><br>Sokodé, Komah 1 - en face du 23è BIR, Togo</li>
                        <li class="mb-3"><strong>Adresse antenne :</strong><br>Kara, Quartier Dongoyo, Togo (centre ouvert)</li>
                        <li class="mb-3"><strong>Téléphone :</strong> <a href="tel:+22890333232">+228 90 33 32 32</a></li>
                        <li class="mb-3"><strong>Email :</strong> <a href="mailto:gf@cial-de.com">gf@cial-de.com</a></li>
                        <li class="mb-3"><strong>Horaires (proposition) :</strong><br>Lun-Ven : 8h00-18h00 | Sam : 8h00-13h00</li>
                        <li><strong>Réseaux sociaux :</strong><br>Facebook : <a href="https://www.facebook.com/share/1DKdTrmYaX/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer">CIAL Togo</a> | TikTok : <a href="https://www.tiktok.com/@cial.togo" target="_blank" rel="noopener noreferrer">@cial.togo</a></li>
                    </ul>
                </div>

                <div class="col-lg-7">
                    <h2 class="section-title-underline mb-4"><span>Écrivez-nous</span></h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">Prénom</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Nom</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary rounded-0 px-4">Envoyer</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title-underline mb-4"><span>Localisation</span></h2>
                </div>
                <div class="col-lg-6 mb-4">
                    <h5>Centre de Sokodé</h5>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe
                            class="embed-responsive-item"
                            src="https://maps.google.com/maps?q=Sokod%C3%A9%20Komah%201&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <h5>Centre de Kara</h5>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe
                            class="embed-responsive-item"
                            src="https://maps.google.com/maps?q=Kara%20Quartier%20Dongoyo%20Togo&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('vitrine.layouts.footer')
@endsection
