@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="card-body">
                                <form method="post" action="{{ route('submitTicket') }}" aria-label="{{ __('Submit Ticket') }}">
                                    @csrf

                                    <b>Personal Details</b>
                                    <div class="form-group row">
                                        <label for="first_name" class="col-sm-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="last_name" class="col-sm-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="msisdn" class="col-sm-4 col-form-label text-md-right">{{ __('Cellphone Number') }}</label>

                                        <div class="col-md-6">
                                            <input id="msisdn" type="number" class="form-control{{ $errors->has('msisdn') ? ' is-invalid' : '' }}" name="msisdn" value="{{ old('msisdn') }}" required autofocus>

                                            @if ($errors->has('msisdn'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('msisdn') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <br>

                                    <b>Ticket Details</b>

                                    <div class="form-group row">
                                        <label for="department" class="col-sm-4 col-form-label text-md-right">{{ __('Department') }}</label>

                                        <div class="col-md-6">
                                            <select id="department" name="department">
                                                <option value="SALES">Sales</option>
                                                <option value="ACCOUNTS">Accounts</option>
                                                <option value="IT">IT</option>
                                            </select>

                                            @if ($errors->has('department'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="issue" class="col-sm-4 col-form-label text-md-right">{{ __('Issue') }}</label>

                                        <div class="col-md-6">

                                            <textarea id="issue" type="text" class="form-control{{ $errors->has('issue') ? ' is-invalid' : '' }}" name="issue" value="{{ old('issue') }}" required autofocus>

                                            </textarea>

                                            @if ($errors->has('issue'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('issue') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit Ticket') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
