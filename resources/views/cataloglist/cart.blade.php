@extends('cataloglist.layout')
  
@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['Price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['ProductName'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">Rp.{{ $details['Price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">Rp.{{ $details['Price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        @if (session()->has('coupon'))
            <tr>
                <td colspan="3" class="text-right">Discount ({{ session()->get('coupon')['namecoupon'] }}) : </td>
                <td><form action="{{ route('coupon.destroy') }}" method="POST" style="display:inline"> 
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit">Remove Coupon</button>
                </form></td>
                <td colspan="5" class="text-right">-Rp.({{ session()->get('coupon')['discountcoupon'] }})</td>
            </tr>
        @endif
        <tr>
            <td colspan="3" class="text-left">
                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                    <input type="text" placeholder="Have a Code ?" name="coupon_code" id="coupon_code">
                    <input type="hidden" placeholder="Have a Code ?" name="total_price" id="total_price" value="{{ $total }}">
                    <button type="submit" class="btn btn-success">Apply</button>
                </form>
            </td>
            @if (!session()->has('coupon'))
            <td colspan="5" class="text-right"><h3><strong>Total Rp.{{ $total }}</strong></h3></td>
            @endif
            @if (session()->has('coupon'))
            <td colspan="5" class="text-right"><h3><strong>Total Rp.{{ $total - session()->get('coupon')['discountcoupon'] }}</strong></h3></td>
            @endif
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('productslist') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success">Checkout</button>
            </td>
        </tr>
    </tfoot>
</table>
@endsection
  
@section('scripts')
<script type="text/javascript">
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>
@endsection