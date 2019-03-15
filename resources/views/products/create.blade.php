@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <h4>
                    <a href="{{ route('products.index') }}">Продукты</a> &rarr; <span class="text-success">+ Создать</span>
                </h4>

                <div class="row">

                    <div class="col mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">
                                    Добавление товара
                                </h2>
                            </div>
                            <div class="card-body">

                                <form method="post" action="{{ route('products.store') }}">
                                    {{ method_field('POST') }}
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="inputName">Название</label>
                                        <input name="name" type="text" class="form-control" id="inputName" placeholder="Название"  {{ app('current_user_permiss')->check('store.name') ? 'required' : 'disabled' }}>
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
                                        <input name="art" type="text" class="form-control" id="inputArt" placeholder="Артикул" {{ app('current_user_permiss')->check('store.art') ? 'required' : 'disabled' }}>
                                        @if($errors->has('art'))
                                            @foreach ($errors->get('art') as $art_error)
                                                <small class="form-text text-danger">⚠ {{ $art_error }}</small><br>
                                            @endforeach
                                        @else
                                            <small class="form-text text-muted">ⓘ Латинские символы и цифры</small>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-outline-success">Добавить</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
