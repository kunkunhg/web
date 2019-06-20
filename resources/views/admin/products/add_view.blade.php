@extends('admin.base')

@section('content')
	<div class="row">
	  <div class="col-md-12 col-lg-12">
	      <h3 class="text-center"> Add product</h3>
	  </div>
	</div>
	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				    <li>{{ $error }}</li>
				        @endforeach
			</ul>
		</div>
	@endif
	
	<div class="alert alert-danger">
		<h3>{{ $mess }}</h3>
	</div>

	<form action="{{ route('admin.handleAddProducts') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="nameProduct"><h4>Name Product : </h4></label>
					<input type="text" class="form-control" name="nameProduct" id="nameProduct" >
				</div>
				<div class="form-group">
					<h4>Categories :</h4>
						@foreach($cat as $key => $item)
							<label for="cat_{{ $item['id'] }}"> {{ $item['name'] }} </label>
							<input type="checkbox" name="cat[]" id="cat_{{ $item['id'] }}" value="{{ $item['id'] }}" multiple>
						@endforeach

				</div>
				<div class="form-group border-top" >
					<h4>Color :</h4>
					@foreach($colors as $key => $item)

						<label for="color_{{ $item['id'] }}">{{ $item['name_color'] }} </label>
						<input type="checkbox" name="color[]" id="color_{{ $item['id'] }}" value="{{ $item['id'] }}" multiple>

					@endforeach
				</div>

				<div class="form-group border-top" >
					<h4>Size :</h4>
					@foreach($size as $key => $item)
						<label for="size_{{ $item['id'] }}">{{ $item['letter_size'] }} </label>
						<input type="checkbox" name="size[]" id="size_{{ $item['id'] }}"
						value="{{ $item['id'] }}" multiple>
					@endforeach
				</div>

				<div class="form-group border-top">
					
						<label for="brands">Brands</label>
						<select name="brands" id="brands" class="form-control col-lg-3">
							@foreach($brands as $key => $item)
								<option value="{{ $item['id'] }}">{{ $item['brand_name'] }}</option>
							@endforeach
						</select>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="price"><h4>Price</h4></label>
					<input type="number" class="form-control" name="price" id="price">
				</div>
				<div class="form-group border-top">
					<label for="qty"><h4>Số lượng</h4></label>
					<input type="number" class="form-control" name="qty" id="qty">
				</div>
				<div class="form-group border-top">
					<label for="images"><h4>Images</h4></label>
					<input type="file" name="images[]" id="images" class="form-control" multiple="multiple">
				</div>
				<div class="form-group border-top mt-3">
					<label for="sale"><h4>Sale off</h4></label>
					<input type="text" name="sale" id="sale" class="form-control">
				</div>
				<div class="form-group border-top mt-3">
					<label for="description"><h4>Description :</h4></label>
					<textarea name="description" id="description" rows="5" class="form-control"></textarea>
				</div>
			</div>
			<div class="col-md-6 offset-md-3 mt-3 mb-3">
				<button type="submit" class="btn btn-primary btn-block">
					ADD+
				</button>
			</div>
		</div>
	</form>
@endsection