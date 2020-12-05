@extends("layout/app")

@section("after-head")

@endsection

@section("body")

@include("layout/nav")
<div class="container-fluid p-0">
    <h1>Shopping Cart!</h1>
    {{ var_dump($cart_items) }}
    <h3>/*Menampilkan data dalam shopping cart!*/</h3>
    <h3>/*Dan button checkout + current subtotal*/</h3>
</div>

@include("layout/footer")

@endsection
