@foreach($products as $product)
<li class="row align-items-center">
    <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
        @if($product->images->isNotEmpty())
        <img src="{{$product->images->first()->image}}" class="img-fluid">
        @else
            <img src="{{asset('images/product1.jpg')}}" srcset="{{asset('images/product1@2x.jpg')}} 2x" class="img-fluid">
        @endif
    </div>
    <div class="col-12 col-md-9 col-lg-8">
        <h4 class="font-medium">{{$product->product_name}}</h4>
        <p class="mb-md-0">{{$product->formulations}}</p>
    </div>
    <div class="col-12 col-lg-2 mt-md-4 mt-lg-0">
        <a href="{{route('products.show',['product'=>$product->id])}}" class="btn btn-primary btn-block">View</a>
    </div>
</li>
@endforeach
{{--
<li class="row align-items-center">
    <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
        <img src="{{asset('images/product1.jpg')}}" srcset="{{asset('images/product1@2x.jpg')}} 2x" class="img-fluid">
    </div>
    <div class="col-12 col-md-9 col-lg-8">
        <h4 class="font-medium">Buying Prescription Drugs In Canada</h4>
        <p class="mb-md-0">Natural Treatments For High Blood Pressure Natural Treatments For High Blood PressureNatural Treatments For High Pressure</p>
    </div>
    <div class="col-12 col-lg-2 mt-md-4 mt-lg-0">
        <a href="" class="btn btn-primary btn-block">View</a>
    </div>
</li>
<li class="row align-items-center">
    <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
        <img src="{{asset('images/product2.jpg')}}" srcset="{{asset('images/product2@2x.jpg')}} 2x" class="img-fluid">
    </div>
    <div class="col-12 col-md-9 col-lg-8">
        <h4 class="font-medium">Should You Take Prescription Medication For</h4>
        <p class="mb-md-0">Natural Treatments For High Blood Pressure Natural Treatments For High Blood PressureNatural Treatments For High Pressure</p>
    </div>
    <div class="col-12 col-lg-2 mt-md-4 mt-lg-0">
        <a href="" class="btn btn-primary btn-block">View</a>
    </div>
</li>
<li class="row align-items-center">
    <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
        <img src="{{asset('images/product3.jpg')}}" srcset="{{asset('images/product3@2x.jpg')}} 2x" class="img-fluid">
    </div>
    <div class="col-12 col-md-9 col-lg-8">
        <h4 class="font-medium">Skin Cancer Prevention 5 Ways To Protect</h4>
        <p class="mb-md-0">Natural Treatments For High Blood Pressure Natural Treatments For High Blood PressureNatural Treatments For High Pressure</p>
    </div>
    <div class="col-12 col-lg-2 mt-md-4 mt-lg-0">
        <a href="" class="btn btn-primary btn-block">View</a>
    </div>
</li>
<li class="row align-items-center">
    <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0">
        <img src="{{asset('images/product4.jpg')}}" srcset="{{asset('images/product4@2x.jpg')}} 2x" class="img-fluid">
    </div>
    <div class="col-12 col-md-9 col-lg-8">
        <h4 class="font-medium">Common Skin Care Myths</h4>
        <p class="mb-md-0">Natural Treatments For High Blood Pressure Natural Treatments For High Blood PressureNatural Treatments For High Pressure</p>
    </div>
    <div class="col-12 col-lg-2 mt-md-4 mt-lg-0">
        <a href="" class="btn btn-primary btn-block">View</a>
    </div>
</li>
--}}

