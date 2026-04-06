<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fiche d'inscription</title>
    <style>
        @page {
            margin: 120px 30px 50px 30px; /* haut, droite, bas, gauche */
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .page-header {
            position: fixed;
            top: -90px;
            left: 0px;
            right: 0px;
            height: 80px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .page-header img {
            width: 100px;
            float: left;
        }
        .school-info {
            float: right;
            text-align: right;
            font-size: 11px;
            color: #555;
        }
        .page-footer {
            position: fixed;
            bottom: -50px; /* Ajusté pour plus d'espace */
            left: 0px;
            right: 0px;
            font-size: 9px;
            color: #555;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            width: 33.33%;
            vertical-align: top;
            padding: 0 5px;
            border: none; /* Annule le style de table par défaut */
            background-color: transparent; /* Annule le style de th par défaut */
        }
        .footer-table .footer-center {
            text-align: center;
        }
        .footer-table .footer-right {
            text-align: right;
        }
        .page-number-container {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
            color: #777;
        }
        .page-number-container:before {
            content: "Page " counter(page);
        }
        .container { width: 100%; margin: 0 auto; }
        .main-title { text-align: center; margin-bottom: 30px; }
        h1 { font-size: 24px; }
        h2 {
            font-size: 18px;
            border-bottom: 2px solid #4a90e2; /* Couleur primaire */
            padding-bottom: 5px;
            color: #333;
            margin-bottom: 15px;
            margin-top: 30px;
        }
        h2:first-of-type {
            margin-top: 0;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 0; }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f8fafc;
            width: 30%;
            font-weight: bold;
            color: #4a5568;
        }
        .signature-section {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .profile-picture {
            float: right;
            width: 120px;
            height: 120px;
            margin-left: 20px;
            margin-bottom: 10px;
            border: 3px solid #eee;
            border-radius: 50%;
            object-fit: cover;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .document-date {
            font-size: 11px;
            color: #777;
            font-style: italic;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        @if($logoSrc)
            <img src="{{ $logoSrc }}"  alt="Logo de l'école">
        @endif
        <div class="school-info">
            <strong>CIAL - Centre Interculturel Allemand</strong><br>
            Komah, non loin de Nagode transfert, Togo<br>
            Tél : (+228) 90 49 84 87 | Email : info@cial-de.com
        </div>
    </div>

    <div class="page-footer">
        <table class="footer-table">
            <tbody>
                <tr>
                    <td>
                        <strong>Directeur Général</strong><br>
                        Yorou Yasser<br>
                        <span color: bleu;>gf@cial-de.com</span>
                    </td>
                    <td class="footer-center">
                        <strong>Centre Interculturel Allemand (CIAL) Sarl U</strong><br>
                        Formation, certifications professionnelles, voyage, tourisme et entrepreneuriat.
                    </td>
                    <td class="footer-right">
                        <strong>Nom du Compte : </strong> YOROU MOUSTAKILOU <br>
                        <strong>Numero de Compte : </strong> 0862 4950 0101 32 <br>
                        <strong>RCCM :</strong> TG-SOK-01-2025-B13-00001 <br>  
                        <strong>NIF :</strong> 1001994527<br>
                        <strong>Web :</strong> cial-de.com | <strong>Tél. :</strong> (+228) 90 49 84 87
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="page-number-container"></div>
    </div>

    <div class="container">
        <div class="main-title">
            <h1>Fiche d'inscription</h1>
            <p class="document-date">Généré le : {{ $date }}</p>
        </div>

        <div class="clearfix">
            @if($studentPhotoSrc)
                <img src="{{ $studentPhotoSrc }}" alt="Photo de {{ $student->first_name }} {{ $student->last_name }}" class="profile-picture">
            @endif

            <h2>Informations de l'étudiant</h2>
            <table>
                <tr><th>Nom complet</th><td>{{ $student->first_name }} {{ $student->last_name }}</td></tr>
                <tr><th>Adresse Email</th><td>{{ $student->email }}</td></tr>
                <tr><th>Date de naissance</th><td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($student->date_of_birth)->age }} ans)</td></tr>
                <tr><th>Niveau de langue</th><td>{{ $student->language_level }}</td></tr>
               @php
                    $fees = [
                        'A1' => '110.000 fr',
                        'A2' => '110.000 fr',
                        'B1' => '110.000 fr',
                        'B2' => '120.000 fr',
                        'C1' => '120.000 fr',
                    ];
                @endphp

                @php
                    $Mois = [
                        'A1' => '2 Mois',
                        'A2' => '2 Mois',
                        'B1' => '2 Mois',
                        'B2' => '2 Mois',
                        'C1' => '3 Mois',
                    ];
                @endphp

                @if(isset($fees[$student->language_level]))
                    <tr><th>Frais de Formation</th><td>{{ $fees[$student->language_level] }}</td></tr>
                @endif
                @if(isset($Mois[$student->language_level]))
                    <tr><th>Durée de la formation</th><td>{{ $Mois[$student->language_level] ?? 'Non spécifié' }}</td></tr>
                @endif
            </table>
        </div>

        @if($student->emergency_contact_name)
            <h2>Contact d'urgence</h2>
            <table>
                <tr><th>Nom du contact</th><td>{{ $student->emergency_contact_name }}</td></tr>
                <tr><th>Relation</th><td>{{ $student->emergency_contact_relationship }}</td></tr>
                <tr><th>Téléphone</th><td>{{ $student->emergency_contact_phone }}</td></tr>
                <tr><th>Email</th><td>{{ $student->emergency_contact_email }}</td></tr>
            </table>
        @endif

        <div class="signature-section">
            <p>Signature de l'étudiant : _________________________</p>
            <br><br>
            <p>Signature de l'administration : _________________________</p>
        </div>
    </div>
</body>
</html>