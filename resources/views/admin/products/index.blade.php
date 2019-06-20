@extends('admin.base')

@section('content')
	<div class="row">
	  <div class="col-md-12 col-lg-12">
	      <h2 class="text-center"> Products</h2>
	      <h3 class="text-center">{{ $mess }}</h3>
	  </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('admin.addProduct') }}" class="btn btn-primary">Add product +</a>
		</div>
	</div>
	<div class="row mt-3" >
		<div class="col-md-12 col-lg-12">
			<table class="table">
				<thead>
					<tr>
						<th>Mã SP</th>
						<th>Tên SP</th>
						<th>Hình ảnh</th>
						<th>Danh mục</th>
						<th>Màu sắc</th>
						<th>Kích thước</th>
						<th>Thương hiệu</th>
						<th>Giá SP</th>
						<th>Số lượng</th>
						<th colspan="2" width="3%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lstPd as $key => $item)
						<tr id="row_{{ $item['id'] }}">
							<td>{{ $item['id'] }}</td>
							<td>{{ $item['name_product'] }}</td>
							<td>
								<img src="{{ URL::to('/') }}/upload/images/{{ $item['image_product'][0] }}" alt="{{ $item['name_product'] }}" width="120" height="200">
							</td>
							<td>
								@foreach($item['categories_id']['name_cat'] as $name)
									<p> + {{ $name }}</p>
								@endforeach
							</td>
							<td>
								@foreach($item['color_id']['name_color'] as $name)
									<p> + {{ $name }}</p>
								@endforeach
							</td>
							<td>
								@foreach($item['size_id']['letter_size'] as $name)
									<p> + {{ $name }}</p>
								@endforeach
							</td>
							<td>{{ $item['brand_name'] }}</td>
							<td>{{ number_format($item['price']) }}</td>
							<td>{{ $item['qty'] }}</td>
							<td>
								<a href="{{ route('admin.editProduct',['id'=> $item['id']]) }}" class="btn btn-info">Edit</a>
							</td>
							<td>
								<button class="btn btn-danger btnDelete" id="{{ $item['id'] }}">Delete</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{-- {{ $link->links() }} --}}
			{{-- phan trang va tim kiem --}}
			{{ $link->appends(request()->query())->links() }}
		</div>
	</div>
@endsection


@push('js')
	<script type="text/javascript">
		$(function(){
			$('.btnDelete').click(function() {
				let self = $(this);
				let idPd = self.attr('id');
				if($.isNumeric(idPd)){
					$.ajax({
						url:"{{ route('admin.deleteProduct') }}",
						type:"POST",
						data: {id: idPd},
						beforeSend: function(){
							self.text('loading ...');
						},
						success: function(result){
							self.text('Delete !');
							result = $.trim(result);
							if (result === 'OK') {
								alert('Delete success');
								//window.location.reload(true);
								$('#row_'+idPd).hide();
							}else{
								alert('Delete fail');
							}
							return false;
						}
					});
				}
			});
		});
	</script>
@endpush