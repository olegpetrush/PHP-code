@extends('layouts.main')

@section('content')

<section class="hero hero-big">
    <div class="container">
        <div class="bg py-7 py-lg-10">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9 text-center mb-5 mb-lg-8">
                    <h1 class="font-bold mb-3">Check Supplement Details</h1>
                    <p class="h5">Find extended product lables of dietary supplement products</p>
                </div>
                <div class="col-lg-9 col-xl-8">
                    <form action="{{route('products.index')}}" method="GET">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <img src="{{asset('images/barcode.svg')}}" alt="">
                                                </div>
                                            </div>
                                            <input type="text"
                                                   class="form-control"
                                                   name="filter[search]"
                                                   placeholder="Product name or bar code number"
                                                   aria-label="Search"
                                                   aria-describedby="searchHelp">
                                        </div>
                                        <small id="searchHelp" class="form-text my-2 mt-lg-3 mb-lg-0">* Enter product name or bar code number</small>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mask"></div>
</section>

<section class="clients py-4 py-lg-6">
    <div class="container" style="display: none">
        <div class="row align-items-center">
            <div class="col-12 col-lg-3 mb-4 mb-lg-0 text-center text-lg-left">
                <span class="d-block text-uppercase">Data Sources</span>
            </div>
            <div class="col-12 col-lg-9">
                <ul class="slider list-unstyled mb-0">
                    <li><img src="{{asset('images/logo.jpg')}}" alt=""></li>
                    <li><img src="{{asset('images/logo.jpg')}}" alt=""></li>
                    <li><img src="{{asset('images/logo.jpg')}}" alt=""></li>
                    <li><img src="{{asset('images/logo.jpg')}}" alt=""></li>
                    <li><img src="{{asset('images/logo.jpg')}}" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
