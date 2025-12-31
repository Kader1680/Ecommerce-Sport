@extends('layouts.master')

@section('content')
<style>
    .about-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fdfdfd;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.7;
    }

    .about-title {
        font-size: 2em;
        font-weight: bold;
        color: #1a1a1a;
        margin-bottom: 20px;
        border-left: 5px solid #4CAF50;
        padding-left: 15px;
    }

    .about-paragraph {
        margin-bottom: 20px;
        text-align: justify;
    }

    .highlight {
        color: #4CAF50;
        font-weight: bold;
    }
</style>

<div class="about-container">
    <div class="about-title">À propos de notre boutique</div>
    
    <p class="about-paragraph">
        Notre boutique en ligne propose une large gamme de <span class="highlight">vêtements de sport</span> pour femmes et hommes, 
        ainsi que des <span class="highlight">accessoires sportifs</span> pratiques et tendance qui vous accompagnent dans vos entraînements 
        et vous font briller à chaque mouvement.
    </p>

    <p class="about-paragraph">
        Nous vous offrons la possibilité de <span class="highlight">personnaliser vos tenues</span> pour qu’elles soient à la fois 
        confortables, esthétiques et motivantes, afin que vous aimiez encore plus faire du sport et que vous vous sentiez 
        confiant(e) à chaque séance.
    </p>

    <p class="about-paragraph">
        Chez nous, <span class="highlight">la qualité, le style et votre bien-être</span> sont notre priorité. 
        Nous sommes toujours à votre service pour vous inspirer et vous équiper au mieux.
    </p>
</div>
@endsection
