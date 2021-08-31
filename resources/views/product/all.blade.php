@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                @foreach($products as $product)
                    <div class="row">
                        <a href="{{route('product.prices', $product)}}" target="_blank">Прайс-лист
                            для {{$product->name}}</a>
                    </div>
                @endforeach
            </div>
            <div class="col-6">
                <span>Получить JSON</span>
                <form action="{{route('api.product.data')}}" class="form ajax-form">
                    @csrf
                    <div class="form-group">
                        <select name="product_id" class="form-control">
                            <option selected disabled hidden>Выберите название продукта</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="option" class="form-control">
                            <option selected disabled hidden>Выберите опцию</option>
                            @foreach($options as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="unit" class="form-control">
                            <option selected disabled hidden>Выберите ед.изм.</option>
                            @foreach($units as $unit)
                                <option value="{{$unit}}">{{$unit}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-secondary" value="Показать">
                    </div>
                </form>
                <span id="json-response"></span>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('submit','.ajax-form',function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: $('.ajax-form').attr('action'),
                    data: $('.ajax-form').serialize(),
                    success: function (data) {
                        $('#json-response').text(JSON.stringify(data));
                    },
                    error: function () {
                        $('#json-response').text('Произошла ошибка');
                    }
                });
            })
        });
    </script>
@endsection
