@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Nutrient Limits
                        @can('create-nutrient-limit')
                            <a href="{{route('nutrient_limits.create')}}" class="btn btn-sm btn-success float-right">Create</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('nutrient_limits.table',[
        'data_url'=>route('nutrient_limits.index',['timestamp'=>now()->timestamp]),
        'data_action_delete'=>true,
        'data_action_update'=>true
        //'data_bulk_delete_url'=>route('effects.bulk_delete',['timestamp'=>now()->timestamp])
        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
