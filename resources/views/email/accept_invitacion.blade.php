@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Aceptar invitación?') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('email.accept',$evento->id) }}">
                            @csrf
                        
                            <div class="form-group row">
                                {{-- <label class="col-md-4 col-form-label text-md-right">{{ __('¿Aceptas la invitación?') }}</label> --}}
                        
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accept" id="acceptYes" value="si" checked>
                                        <label class="form-check-label" for="acceptYes">
                                            Sí
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accept" id="acceptNo" value="no">
                                        <label class="form-check-label" for="acceptNo">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enviar Respuesta') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
