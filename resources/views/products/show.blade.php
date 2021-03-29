@extends('layouts.main')

@section('content')

    <section class="product py-4 py-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 mb-4 mb-lg-5">
                <div class="row">
                    <div class="col-12 col-xl-9">
                        <ul class="breadcrumbs list-unstyled mb-4 mb-lg-5">
                            <li><a href="">{{$product->category ?? 'No category'}}</a></li>
                            <li>{{$product->subcategory ?? 'No subcategory'}}</li>
                        </ul>
                        <h3 class="font-bold mb-1">{{$product->product_name}}</h3>
                        <div class="rating clearfix mb-4 mb-lg-5">
                            <ul class="stars clearfix list-unstyled d-inline mb-0">
                                <li><img src="{{asset('images/star.svg')}}" alt=""></li>
                                <li><img src="{{asset('images/star.svg')}}" alt=""></li>
                                <li><img src="{{asset('images/star.svg')}}" alt=""></li>
                                <li><img src="{{asset('images/star.svg')}}" alt=""></li>
                                <li><img src="{{asset('images/star.svg')}}" alt=""></li>
                            </ul>
                            <span class="d-inline">124 reviews</span>
                        </div>
                        <p class="mb-0">A number of “dangerous drugs” have been in the news recently. These reports started to surface when Congress was having hearings </p>
                        <ul class="features clearfix list-unstyled my-4 my-lg-5">
                            <li>No-GMO</li>
                            <li>No Sodium</li>
                            <li>No Sodium</li>
                            <li>No Sugar</li>
                            <li>Kosher</li>
                        </ul>
                        <div class="row">
                            <div class="col-md-7 mb-2 mb-md-0">
                                <a href="" class="btn btn-primary btn-add btn-lg btn-block"><img src="{{asset('images/plus-icon.svg')}}" alt=""> Add to Daily List</a>
                            </div>
                            <div class="col-md-5">
                                <a href="" class="btn btn-secondary btn-chat btn-lg btn-block"><img src="{{asset('images/sms.svg')}}" alt=""> Ask a Dietitian</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-xl-9">
                <div class="accordion" id="accordionProduct">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="font-medium mb-0">
                                <button class="btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Directions
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionProduct">
                            <div class="card-body">
                                {{$product->directions}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="font-medium mb-0">
                                <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Precautions
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionProduct">
                            <div class="card-body">
                                <p class="mb-0">
                                    {{$product->precautions}}
                                    <a href="">Note by dietitian</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="font-medium mb-0">
                                <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Supplement Interactions
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionProduct">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="font-medium mb-0">
                                <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Side Effects & Drug Interactions
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionProduct">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="font-medium mb-0">
                                <button class="btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Ingredients
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionProduct">
                            <div class="card-body">
                                @if($product->ingredients->isNotEmpty())
                                <p>Serving Size: {{$product->ingredients->first()->serving_size}}</p>
                                @endif
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Daily Value</th>
                                        <th scope="col">Max Daily Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->ingredients as $ingredient)
                                    <tr>
                                        <th scope="row">{{$ingredient->dietary_ingredient_synonym_source}}</th>
                                        <td>{{$ingredient->amount_per_serving}} {{$ingredient->amount_serving_unit}}</td>
                                        <td>{{$ingredient->pct_daily_value_per_serving}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    @if(!empty($similar_products))
        @include('products.similar')
    @endif
@endsection
