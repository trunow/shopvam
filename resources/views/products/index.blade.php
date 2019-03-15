@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">

            <div>
                <h4 class="float-left">
                    Продукты
                    @if(app('current_user_permiss')->check('create'))
                        <a href="{{ route('products.create') }}" class="ml-2 btn btn-outline-success btn-sm">+ создать</a>
                    @endif
                </h4>
                <form class="form-inline nav nav-pills justify-content-end">
                    <span class="nav-item">
                        <input class="form-control" id="search" type="text" name="q" value="{{ Request::input('q') ?? '' }}" placeholder="🔍"/>
                    </span>
                    <span class="nav-item">
                        <button class="btn btn-light btn-link nav-link {{ Request::input('per_page') == 1 ? 'active' : '' }}" name="per_page" value="1">1</button>
                    </span>
                    <span class="nav-item">
                        <button class="btn btn-light btn-link nav-link {{ Request::input('per_page') == 10 ? 'active' : '' }}" name="per_page" value="10">10</button>
                    </span>
                    <span class="nav-item">
                        <button class="btn btn-light btn-link nav-link {{ Request::input('per_page') == 100 ? 'active' : '' }}" name="per_page" value="100">100</button>
                    </span>
                    <span class="nav-item">
                        <button class="btn btn-light btn-link nav-link {{ Request::input('per_page') >= 1000 || Request::input('per_page') === "0" ? 'active' : '' }}" name="per_page" value="0">1000 +удалённые</button>
                    </span>
                    <span class="nav-item">
                        <button class="btn btn-light btn-link nav-link {{ Request::input('order_by') !== "▼" ? 'active' : '' }}" name="order_by" value="▲">▲</button>
                    </span>
                    <span class="nav-item">
                        <button class="btn btn-light btn-link nav-link {{ Request::input('order_by') === "▼" ? 'active' : '' }}" name="order_by" value="▼">▼</button>
                    </span>
                </form>
            </div>

            @if($products->count())
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-6 mt-3">
                        <div class="card {{ $product->trashed() ? 'trashed' : '' }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $product->name }}
                                    @if(app('current_user_permiss')->check('edit'))
                                        <a href="{{ route('products.edit', $product) }}" class="ml-2 btn btn-outline-info btn-sm">✏</a>
                                    @endif
                                </h5>
                                <p class="card-text">Арт. {{ $product->art }}</p>
                                <p>
                                    <button class="btn btn-outline-primary float-left" data-toggle="modal" data-target="#orderModal" data-whatever="{{ $product->name }}">🛒 Купить</button>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-link float-right">Подробнее</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <nav class="mt-5">{{ $products->links('products.partials.paginate') }}</nav>

            @else

                <p>Здесь ничего нет</p>

            @endif

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
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body text-center p-4">
                            😈 Хотеть не вредно
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
