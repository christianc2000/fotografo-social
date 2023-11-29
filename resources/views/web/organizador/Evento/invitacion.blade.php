@extends('adminlte::page')
@section('title', 'Invitacion')

@section('content_header')
    <h1>Evento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-head">
            <H1>Invitar al evento {{ $evento->title }}</H1>
        </div>
        <div class="card-body">
            <form action="{{ route('email.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    
                    <input type="hidden" name="evento" value={{ $evento->id }}>
                </div>
                <button type="submit" class="btn btn-primary">Enviar invitación</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
