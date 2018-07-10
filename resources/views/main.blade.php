@extends('_main_template')
@section('content')


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        getProducts();


        $('#submit-test').on('submit',function(e){
            alert('submitting');
            e.preventDefault(e);
            $.ajax({
                type:"POST",
                url:'/product',
                data:$(this).serialize(),
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    getProducts();
                },
                error: function(data){

                }
            });
            return false;
        });
    });
    $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });

    function getProducts(){
        $.ajax({
            type:"GET",
            url:'/products',
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data){
                $('#results').html("");
                var total_price = 0;
                $.each(data, function(index, value){
                    console.log(value);

                    total_price += value.price * value.quantity;
                    $('#results').append('<div class="row"><div class="col-sm-2">'+value.product_name+'</div><div class="col-sm-2">'+value.quantity+'</div><div class="col-sm-2">'+value.price+'</div> <div class="col-sm-2">'+value.timestamp+'</div> <div class="col-sm-2">'+(value.price*value.quantity)+'</div></div>');
                });
                $('#results').append('<div class="row"><div class="col-sm-2">Total: '+total_price+'</div></div>');

                console.log(data);
            },
            error: function(data){
            }
        });
    }
</script>
    TEST
<div class="row">
    <div class="col-sm-12">

        <form id="submit-test">
            <input name="product_name" placeholder="Product Name" class="form-control">
            <br />
            <input type="number" name="quantity" placeholder="Quantity In Stock" class="form-control">
            <br />
            <input type="number" step="0.01" name="price" placeholder="Price per item" class="form-control">
            <br />
            <input type="submit" class="form-control" value="submit">

        </form>
        <div class="row">
            <div class="col-sm-2">product name</div>
            <div class="col-sm-2">quantity in stock</div>
            <div class="col-sm-2">price per item</div>
            <div class="col-sm-2">datetime submtited</div>
            <div class="col-sm-2">total value</div>

        </div>
        <div id="results">

        </div>

    </div>
</div>
@endsection
