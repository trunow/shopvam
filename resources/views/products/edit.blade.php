@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <h4>
                    <a href="{{ route('products.index') }}">Продукты</a> &rarr; <span class="text-danger">✏ {{ $product->name }}</span>
                </h4>

                <div class="row">

                    <div class="col mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title">
                                    {{ $product->name }}
                                    <a href="{{ route('products.show', $product) }}" class="ml-2 btn btn-outline-success btn-sm">👁</a>
                                </h1>
                            </div>
                            <div class="card-body">

                                <form id="editForm" method="post" action="{{ route('products.update', $product) }}">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="inputName">Название</label>
                                        <input name="name" value="{{ $product->name }}" type="text" class="form-control" id="inputName" placeholder="Название"  {{ app('current_user_permiss')->check('edit.name') ? 'required' : 'disabled' }}>
                                        @if($errors->has('name'))
                                            @foreach ($errors->get('name') as $name_error)
                                                <small class="form-text text-danger">⚠ {{ $name_error }}</small><br>
                                            @endforeach
                                        @else
                                            <small class="form-text text-muted">ⓘ Не менее 10 символов</small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="inputArt">Артикул</label>
                                        <input name="art" value="{{ $product->art }}" type="text" class="form-control" id="inputArt" placeholder="Артикул"  {{ app('current_user_permiss')->check('edit.art') ? 'required' : 'disabled' }}>
                                        @if($errors->has('art'))
                                            @foreach ($errors->get('art') as $art_error)
                                                <small class="form-text text-danger">⚠ {{ $art_error }}</small><br>
                                            @endforeach
                                        @else
                                            <small class="form-text text-muted">ⓘ Латинские символы и цифры</small>
                                        @endif
                                    </div>

                                    <input type="hidden" name="id" value="{{ $product->id }}" />

                                    <p>
                                        <button type="submit" class="btn btn-primary float-left">Сохранить</button>
                                        @if(app('current_user_permiss')->check('destroy'))
                                            <button type="submit" form="deleteForm" class="btn btn-outline-danger float-right">🗑 Удалить</button>
                                        @endif
                                    </p>
                                </form>

                                <form id="deleteForm" method="post" action="{{ route('products.destroy', $product) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
