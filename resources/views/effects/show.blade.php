@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="py-2 mb-0">Effect:
                                    {{$effect->name}}
                                </h3>
                            </div>
                            <div class="col-2 text-right">
                                @can('delete-effect',$effect)
                                <form action="{{route('effects.destroy',['effect'=>$effect->id])}}" method="post"
                                      data-effect-delete-form data-redirect-to="{{route('effects.index')}}">
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
                                    @include('effects.form_inputs')
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

