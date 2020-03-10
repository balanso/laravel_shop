@extends('auth.layouts.master')

@isset($product)
@section('title', 'Редактировать товар ' . $product->name)
@else
@section('title', 'Создать товар')
@endisset

@section('content')
<div class="col-md-12">
  @isset($product)
  <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
  @else
  <h1>Добавить товар</h1>
  @endisset

  <form method="POST" enctype="multipart/form-data" @isset($product) action="{{ route('products.update', $product) }}"
    @else action="{{ route('products.store') }}" @endisset>
    <div>
      @isset($product)
      @method('PUT')
      @endisset
      @csrf
      <div class="input-group row">
        <label for="name" class="col-sm-2 col-form-label">Название: </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="name" id="name"
            value="{{ old('name', isset($product) ? $product->name : '')}}">
          @include('auth.layouts.error', ['fieldName'=>'name'])
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="code" class="col-sm-2 col-form-label">Код: </label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="code" id="code"
            value="{{ old('code', isset($product) ? $product->code : '')}}">
          @include('auth.layouts.error', ['fieldName'=>'code'])
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="name" class="col-sm-2 col-form-label">Цена: </label>
        <div class="col-sm-6">
          <input type="integer" class="form-control" name="price" id="price"
            value="{{ old('price', isset($product) ? $product->price : '')}}">
          @include('auth.layouts.error', ['fieldName'=>'price'])
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="name" class="col-sm-2 col-form-label">Категория: </label>
        <div class="col-sm-6">
          <select class="form-control" name="category_id" id="category_id">
            @forelse ($categories as $category)
            <option value="{{$category->id}}" @if ( old('category_id')==$category->id || (isset($product) &&
              $product->category_id == $category->id)) }}
              selected
              @endif
              ">{{$category->name}}</option>

            @empty
            <option value="0" disabled selected>Категории не найдены</option>
            @endforelse

          </select>
          @include('auth.layouts.error', ['fieldName'=>'category_id'])
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="description" class="col-sm-2 col-form-label">Описание: </label>
        <div class="col-sm-6">
          <textarea name="description" id="description" cols="72"
            rows="7">{{ old('description', isset($product) ? $product->description : '')}}</textarea>
        </div>
      </div>
      <br>
      <div class="input-group row">
        <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
        <div class="col-sm-10">
          @isset($product->image)
          <img src="{{ Storage::url($product->image) }}" height="240px">
          @endisset
          <label class="btn btn-default btn-file">
            Загрузить <input type="file" style="display: none;" name="image" id="image">
          </label>
          @include('auth.layouts.error', ['fieldName'=>'image'])
        </div>
      </div>
      <br>
      @foreach (['new' => 'Новинка', 'hit' => 'Хит продаж', 'recommend' => 'Рекомендуемые'] as $field => $title)
      <div class="input-group row">
        <label for="{{ $field }}" class="col-sm-2 col-form-label">{{ $title }}: </label>
        <div class="col-sm-1">
          <input type="checkbox" class="form-control" name="{{ $field }}" id="{{ $field }}" @if (isset($product) && $product->$field == 1) checked
              
          @endif>
          @include('auth.layouts.error', ['fieldName'=>$field])
        </div>
      </div>
      @endforeach
      <br>
    </div>
    <button class="btn btn-success">Сохранить</button>

  </form>
</div>
@endsection