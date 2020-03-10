@extends('layouts.master', ['file'=>1]);

@section('title', 'Товар ' . $product->name)

@section('content')
<h1>{{ $product->name }}</h1>
<h2>{{ $product->category->name }}</h2>
<p>Цена: <b>{{ $product->price }} руб.</b></p>
<img src="{{ Storage::url($product->image) }}" width="300">
<p>{{ $product->description }}</p>

<form action="/basket/add/2" method="POST">
  <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

  <input type="hidden" name="_token" value="AkAQkIzOeDc8YYXOCrW4yl2kWPPFuYqHfTW9oLh0"> </form>
@endsection