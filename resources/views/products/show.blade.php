@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <h4>
                    <a href="{{ route('products.index') }}">Продукты</a> &rarr; <span class="text-muted">{{ $product->name }}</span>
                </h4>

                <div class="row">

                    <div class="col mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title">
                                    {{ $product->name }}
                                    @if(app('current_user_permiss')->check('edit'))
                                        <a href="{{ route('products.edit', $product) }}" class="ml-2 btn btn-outline-info btn-sm">✏</a>
                                    @endif
                                </h1>
                            </div>
                            <div class="card-body">
                                <h5>
                                    {{ $product->name }}
                                </h5>
                                <p class="card-text">Арт. {{ $product->art }}</p>
                                <p class="card-text"><small>Добавлен: {{ \Carbon\Carbon::parse($product->created_at)->format('d.m.Y') }}</small></p>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#orderModal" data-whatever="{{ $product->name }}">🛒 Купить</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderModalLabel">Заказ товара</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="qty" class="col-form-label">Кол-во:</label>
                                        <input type="text" class="form-control" id="qty" placeholder="штук">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment" class="col-form-label">Ваш комментарий:</label>
                                        <textarea class="form-control" id="comment" placeholder="например: адрес доставки"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Не хочу</button>
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-dismiss="modal" data-target=".fuck-modal">Хочу!</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- checkout modal -->
                <div class="modal fade fuck-modal" tabindex="-1" role="dialog" aria-labelledby="fuckModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                🙈 Ваше мнение очень важно для нас
                            </div>
                        </div>
                    </div>
                </div>

                <script src="//code.jquery.com/jquery-latest.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#orderModal').on('show.bs.modal', function (event) {
                            var whatever = $(event.relatedTarget).data('whatever')
                            $(this).find('.modal-title').text('' + whatever)
                            //$(this).find('.modal-body input').val(whatever)
                        });
                        $('.fuck-modal').on('show.bs.modal', function (event) {
                            $(this).find('.modal-body').animate({fontSize: '1.4em', opacity: .5}, 3000)
                        });
                    });
                </script>

            </div>

        </div>
    </div>
@endsection
