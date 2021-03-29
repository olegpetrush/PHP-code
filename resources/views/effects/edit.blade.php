@extends('layouts.app')

@section('content')
    <div class="container-fluid" >
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Edit Effect
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('effects.update',['effect'=>$effect->id])}}"
                                      method="POST"
                                      enctype="application/x-www-form-urlencoded"
                                >
                                    @csrf
                                    @method('PATCH')
                                    @include('effects.form_inputs')
                                    <div class="form-group row">
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
