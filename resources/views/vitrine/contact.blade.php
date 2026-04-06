@extends('vitrine.layouts.app')

@section('content')
   
    @include('vitrine.layouts.header')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('vendors/images/bg_1.jpg') }}')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Contact</h2>
              <p>contactez-nous pour plus d'informations.</p>
            </div>
          </div>
        </div>
      </div> 
    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{ url('/') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Contact</span>
      </div>
    </div>
    <div class="site-section">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control form-control-lg" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control form-control-lg" value="{{ old('last_name') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone">Tel. Number</label>
                        <input type="text" id="phone" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" cols="30" rows="10" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    @include('vitrine.layouts.footer')
@endsection
