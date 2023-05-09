@extends('layouts.app')
@section('title')
@if ($product->category)
    {{ $product->category->slug }}
@else
    Category Not Found
@endif
@endsection

@section('content')


<div>
    <livewire:frontend.product.view :product="$product" :category="$category"/>
</div>

@endsection