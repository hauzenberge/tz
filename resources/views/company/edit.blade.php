 @extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel-body">       
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="col-sm-10">



            <!-- Display Validation Errors -->
            @include('common.errors')
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/company/update/'.$company->id) }}">
                        {!! csrf_field() !!}

                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Имя Компании</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $company->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $company->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Ссылка на логотип</label>

                            <div class="col-md-6">
                                <img src="{{ $company->logo }}" alt="Логотип не загружен" width="400px" height="auto">
                                <br>
                                <br>
                                <input type="text" class="form-control" name="logo" value="{{ $company->logo }}">

                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"><a href="{{ $company->site }}" target="_blank">Cсылка на сайт</a></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="site" value="{{ $company->site }}">

                                @if ($errors->has('site'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Обновить компанию
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
</div>
</div>
@endsection