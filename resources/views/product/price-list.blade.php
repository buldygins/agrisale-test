@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Прайс-лист для {{$product->name}}</h2>
        <table class="table table-bordered yajra-datatable">
            <thead>
            <tr>
                <th>id</th>
                <th>Продавец</th>
                <th>Опция</th>
                <th>Ед.изм.</th>
                <th>Базовая Цена</th>
                <th>Выбрать</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                ajax: "{{ route('api.product.prices', $product) }}",
                columns: [
                    {data: 'id', name: 'product_offers.id'},
                    {data: 'name', name: 'dealers.name'},
                    {data: 'product_variation.option', name: 'option', sortable: false,},
                    {data: 'product_variation.unit', name: 'unit', sortable: false,},
                    {data: 'price', name: 'price'},
                    {
                        data: 'action',
                        name: 'action',
                        sortable: false,
                    },
                ]
            });

            $(document).on('click','.show-product-offer-id',function () {
                $('.modal-body').text($(this).data('id'));
                $('.modal').modal();
            })
        });
    </script>
@endsection
