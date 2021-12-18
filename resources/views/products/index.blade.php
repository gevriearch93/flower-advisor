@extends('products.layout')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="row">
	
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Flower Advisor</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>
			<br>
		</div>
	</div>
</div>

@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
@endif
<br>
<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Produk</th>
		<th>Harga</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($products as $product)
	<tr>
		<td>{{ ++$i }}</td>
            <td>{{ $product->ProductName }}</td>
            <td>{{ $product->Price }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection