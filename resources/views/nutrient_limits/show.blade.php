@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="py-2 mb-0">Nutrient Limit:
                                    {{$nutrient_limit->id}}
                                </h3>
                            </div>
                            <div class="col-2 text-right">
                                @can('delete-nutrient-limit',$nutrient_limit)
                                <form action="{{route('nutrient_limits.destroy',['nutrient_limit'=>$nutrient_limit->id])}}" method="post"
                                      data-nutrient-limit-delete-form data-redirect-to="{{route('nutrient_limits.index')}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Click to delete">Delete
                                    </button>
                                </form>
                                @endcan
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="row">
                                <div class="col-12">
                                    @include('nutrient_limits.form_inputs')
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

