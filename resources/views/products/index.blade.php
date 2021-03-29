@extends('layouts.main')

@section('content')
    <section class="hero hero-small">
        <div class="container">
            <div class="bg py-5 py-lg-7">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-xl-8">
                        <form action="{{route('products.index')}}" method="GET">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="form-group mb-4">
                                        <div class="form-check form-check-inline custom-control custom-radio mb-2">
                                            <input type="radio" id="customRadio1" name="customRadio"
                                                   class="custom-control-input" checked="checked">
                                            <label class="custom-control-label h5" for="customRadio1">Check
                                                Product</label>
                                        </div>
                                        <div class="form-check form-check-inline custom-control custom-radio mb-2">
                                            <input type="radio" id="customRadio2" name="customRadio"
                                                   class="custom-control-input">
                                            <label class="custom-control-label h5" for="customRadio2">Find
                                                Products</label>
                                        </div>
                                        <div class="form-check form-check-inline custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio"
                                                   class="custom-control-input">
                                            <label class="custom-control-label h5" for="customRadio3">Ask a
                                                Dietitian</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">@</div>
                                                </div>
                                                <input type="text"
                                                       class="form-control"
                                                       name="filter[search]"
                                                       placeholder="Product name or bar code number"
                                                       aria-describedby="searchHelp">
                                            </div>
                                            <small id="searchHelp" class="form-text my-2 mt-lg-3 mb-lg-0">* Enter
                                                product name or bar code number</small>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-secondary btn-lg btn-block">Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <ul class="product-list list-unstyled">
                        @include('products.search_results')
                    </ul>
                </div>
            </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
