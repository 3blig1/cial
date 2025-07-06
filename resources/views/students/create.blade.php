@extends('layouts.app')

@section('title', 'Ajouter un Élève')

@section('header-content')

        <a href="{{ route('students.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
            <i class="ri-arrow-left-line"></i>
            <span>Retour à la liste</span>
        </a>
        <div class="flex items-center gap-4">
            {{-- User profile dropdown can be added here --}}
        </div>
    
@endsection

@section('content')
<h1 class="text-2xl font-semibold mb-8">Ajouter un Élève</h1>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Oups !</strong>
        <span class="block sm:inline">Il y a eu des erreurs avec votre saisie.</span>
        <ul class="mt-3 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        <div class="flex flex-col items-center">
            <div class="relative group">
                <div class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                    <img id="preview" class="w-full h-full object-cover hidden">
                    <div class="w-8 h-8 flex items-center justify-center text-gray-400">
                        <i class="ri-user-line text-2xl"></i>
                    </div>
                </div>
                <label class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center cursor-pointer">
                    <input type="file" name="profile_photo" class="hidden" accept="image/*" onchange="previewImage(event)">
                    <div class="w-4 h-4 flex items-center justify-center text-gray-600">
                        <i class="ri-camera-line"></i>
                    </div>
                </label>
            </div>
            <p class="mt-2 text-sm text-gray-500">Photo de profil</p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Niveau de langue initial</label>
            <div class="flex items-center gap-8">
                @foreach(['A1', 'A2', 'B1', 'B2', 'C1'] as $level)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="language_level" value="{{ $level }}" @if(old('language_level') == $level) checked @endif>
                    <div class="custom-radio"></div>
                    <span class="text-sm">{{ $level }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        <h2 class="text-lg font-medium">Contact d'urgence</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="emergency_contact_relationship" class="block text-sm font-medium text-gray-700 mb-1">Relation</label>
                <input type="text" name="emergency_contact_relationship" id="emergency_contact_relationship" value="{{ old('emergency_contact_relationship') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20">
            </div>
            <div>
                <label for="emergency_contact_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="emergency_contact_email" id="emergency_contact_email" value="{{ old('emergency_contact_email') }}" class="w-full px-3 py-2 border-none bg-gray-50 rounded focus:ring-2 focus:ring-primary/20">
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-button hover:bg-primary/90">Enregistrer</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                preview.parentElement.querySelector('div').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush