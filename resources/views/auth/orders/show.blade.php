@extends('auth.layouts.master')

@section('title', 'Заказ №'.$order->id)

@section('content')
<div class="col-md-12">
  <h1>Заказ №{{$order->id}}</h1>
  <p>Имя: {{ $order->name }}</p>
  <p>Телефон: {{ $order->phone }}</p>
  <p>Email: {{ $order->email }}</p>

  <h2>Товары в заказе</h2>
  <table class="table">
    <tbody>
      <tr>
        <th>
          Изображение
        </th>
        <th>
          Название
        </th>
        <th>
          Количество
        </th>
        <th>
          Цена
        </th>
        <th>
          Стоимость
        </th>
      </tr>
      @foreach($order->products as $product)
      <tr>
        <td><a href="{{ route('products.show', $product) }}"><img height="50" src="{{ Storage::url($product->image)  }}"></a></td>
        <td>{{ $product->name }}</td>
        <td><span class="badge">1</span></td>
        <td>{{ $product->price }} руб.</td>
        <td>{{ $product->getPriceForCount() }} руб.</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="5">
          Итого: {{ $order->calculate() }} руб.
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection