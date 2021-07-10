@extends('layouts.app')

@section('content')
<div class="container">
    <div>
    <h1>landing page</h1>
    <a href="{{ route('product.index') }}" class="btn btn-primary">Products</a>

    </div>
    <section>
        <div class="row">
            @foreach($latestProducts as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p><strong> $ {{ $product->price }}</strong></p>
                        <a href="#" class="btn btn-primary">bay</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
