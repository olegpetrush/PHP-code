<section class="py-4 py-lg-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 mb-4 mb-lg-5">
                <h4 class="font-bold mb-0">Similar products</h4>
            </div>
            <div class="col-lg-10 col-xl-9">
                <ul class="product-list list-unstyled">
                    @foreach($similar_products as $similar_product)
                    <li class="row align-items-center">
                        <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
                            @if($similar_product->images->isNotEmpty())
                                <img src="{{$similar_product->images->first()->image}}" class="img-fluid">
                            @else
                                <img src="{{asset('images/product1.jpg')}}" srcset="{{asset('images/product1@2x.jpg')}} 2x" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-12 col-md-9 col-lg-8">
                            <h4 class="font-medium">{{$similar_product->product_name}}</h4>
                            <p class="mb-md-0">{{$similar_product->description}}</p>
                        </div>
                        <div class="col-12 col-lg-2 mt-md-4 mt-lg-0">
                            <a href="{{route('products.show',['product'=>$similar_product->id])}}" class="btn btn-primary btn-block">View</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
