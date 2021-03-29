@extends('layouts.app')

@section('content')
    <div class="container-fluid" >
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Edit Nutrient Limit
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('nutrient_limits.update',['nutrient_limit'=>$nutrient_limit->id])}}"
                                      method="POST"
                                      enctype="application/x-www-form-urlencoded"
                                >
                                    @csrf
                                    @method('PATCH')
                                    @include('nutrient_limits.form_inputs')
                                    <div class="form-group row float-right">
                                        <div class="btn btn-group">
                                            <button class="btn btn-success" type="submit">Edit</button>
                                            <button class="btn btn-warning" type="reset">Reset</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection