@extends('adminlte::page')

@section("title",($model->exists)?"$model->title- {$model->id}" :"Add A New Products")

@section('header-right')
    <a href="{{ route('products.index') }}" class="btn btn-raised btn-raised  mr-1 round mb-0"><i
            class="ft-arrow-left"></i> </a>
    @if($model->exists)
        <a href="{{ route('products.create') }}"
           class="btn btn-raised btn-raised btn-info mr-1 round mb-0">
            <i class="fa fa-plus-circle"></i>
        </a>
    @endif
@endsection
@section('content')
    <section id="basic-form-layouts">
        <div class="card">
            <div class="card-body">
                <div class="px-3">
                    <form method="post" class="form"
                          enctype="multipart/form-data"
                          action="{{ ($model->exists)? route('products.update', [$model->id]): route('products.store') }}">
                        @if ($model->exists)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-title"></i> Products Info</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shop_title">Title</label>
                                        <input type="text" id="title"
                                               class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                               value="{{ (old('title'))? old('title'): $model->title }}"
                                               placeholder="Title"
                                               name="title">
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shop_phone">Pice</label>
                                        <input type="number" id="price"
                                               class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                               value="{{ (old('price'))? old('price'): $model->price }}"
                                               placeholder="price"
                                               name="price">
                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('price') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="orders_quote">Description</label>
                                        <textarea type="text"
                                                  class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                  value="{{ (old('description'))? old('description'): $model->description }}"
                                                  placeholder="Description ..."
                                                  name="description">{{old('description')}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-raised btn-raised btn-primary">
                                    <i class="fa fa-check-square-o"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
