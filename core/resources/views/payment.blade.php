@extends('layouts.master')

@section('content')
<style>
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 25px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .btn-submit {
        width: 100%;
        background-color: #007bff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        text-align: center;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 15px;
    }

    .logo-container img {
        width: 120px;
    }
</style>

<div class="form-container">
    <div class="logo-container">
        <!-- Poste Algérie logo (Replace with local image if needed) -->
        <img src="https://ebourse.dz/wp-content/uploads/2017/12/AlgeriePoste.svg_.png" alt="Poste Algérie">
    </div>

    <h2>Paiement par CCP</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif


    <form action="{{ route('submit',  $order->id ) }}"   method="POST">


        @csrf
        {{-- <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" required>
        </div>
         --}}
    
        <div class="form-group">
            <label for="ccp_number">Numéro CCP</label>
            <input type="text" id="ccp_number" name="ccp_number" required placeholder="1234567">
        </div>

        <div class="form-group">
            <label for="cle_rib">Clé RIB</label>
            <input type="text" id="cle_rib" name="cle_rib" required placeholder="00">
        </div>

        <div class="form-group">
            <label for=" amount ">amount</label>
            <input   id="amount" name="amount" step="0.01"
            
            value="{{  $order->total_price  }}"    
            required>
        </div>

        <button type="submit" class="btn-submit">Envoyer le Paiement</button>
    </form>
</div>
@endsection
