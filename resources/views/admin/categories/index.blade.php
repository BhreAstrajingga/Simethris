@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/formplugins/bootstrap-colorpicker/bootstrap-colorpicker.css') }}">
@endsection
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
    @can('feeds_access')
		@include('partials.sysalert')
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>Category</h2>
				<div class="panel-toolbar">
					@if (\Auth::user()->roleaccess == '1')
					<button type="button"
						class="btn btn-info btn-xs waves-effect waves-themed"
						data-toggle="modal"
						data-target=".new-example-modal-right-sm">
						<i class="fal fa-plus-circle mr-1"></i>Add New Category
					</button>
					@endif
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div>
						<table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
							<thead class="bg-primary-600">
								<tr>
									<th>Title</th>
									<th>Hex Color</th>
									<th>Text Color</th>
									<th>Posts</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								{{-- {{ dd($categories) }} --}}
								@foreach ($categories as $category)
								<tr>
									<td> 
										<a href="{{ route('admin.categories.show', $category->id) }}" class="fw-700" style="color: {{($category->hexcolor)}} ;" title="See All Posts with {{ $category->name }} Category">{{$category->name}}</a>
									</td>
									<td>
										<i class="fas fa-square border mr-1"
											style="color: {{$category->hexcolor}};"></i>
										{{$category->hexcolor}}
									</td>
									<td>
										<i class="fas fa-square border mr-1"
										style="color: {{$category->textcolor}};"></i>
										{{$category->textcolor}}
									</td>
									<td> {{$category->post_count}} posts</td>
									<td class="text-center">
										<a href="{{ route('admin.categories.show', $category->id) }}"
											class="btn btn-sm btn-primary btn-icon"
											title="See All Posts with {{ $category->name }} Category">
											<i class="fas fa-newspaper"></i>
										</a>
										@if (\Auth::user()->roleaccess == '1')
										<button type="submit" class="btn btn-sm btn-warning btn-icon"
											data-toggle="modal"
											data-target="#editCategory{{ $category->id }}"
											title="Perbarui/Ubah Artikel">
											<i class="fas fa-edit"></i>
										</button>
										<button type="submit" class="btn btn-sm btn-danger btn-icon"
											title="Hapus Artikel">
											<i class="fas fa-trash-alt"></i>
										</button>
										@endif
									</td>
									<!-- Edit Category Modal -->
									<div class="modal fade edit-example-modal-right-sm"
										tabindex="-1" role="dialog" aria-hidden="true"
										id="editCategory{{ $category->id }}">
										<div class="modal-dialog modal-dialog-right modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title h4">Edit Category</h5>
													<button type="button" class="close"
													data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true"><i class="fal fa-times"></i></span>
													</button>
												</div>
												<form method="POST" action="{{ route('admin.categories.update', [$category->id]) }}" enctype="multipart/form-data">
													@csrf
													@method('PUT')
													<div class="modal-body">
														<div class="form-group">
															<label for="category_name">Category Name</label>
															<input type="text" name="category_name"
															id="category_name" class="form-control"
															placeholder="Category Name" aria-describedby="helpId"
															value="{{ old('name', $category->name) }}">
															<small id="helpId" class="text-muted">Category name</small>
														</div>
														<div class="form-group">
															<label for="hexcolor">Category Color</label>
															<div class="input-group" id="hexcolor">
																<input type="text" name="hexcolor"
																	id="hexcolor" class="form-control"
																	placeholder="Category Color" aria-describedby="helpId"
																	value="{{ old('hexcolor', $category->hexcolor) }}">
																<span class="input-group-append form">
																	<span class="input-group-text colorpicker-input-addon"><i></i></span>
																</span>
															</div>
															<small id="helpId" class="text-muted">Hex Color are used for category color.</small>
														</div>
														<div class="form-group">
															<label for="textcolor">Category Text Color</label>
															<div class="input-group" id="textcolor">
																<input type="text" name="textcolor"
																	id="textcolor" class="form-control"
																	placeholder="Category Color" aria-describedby="helpId"
																	value="{{ old('textcolor', $category->textcolor) }}">
																<span class="input-group-append form">
																	<span class="input-group-text colorpicker-input-addon"><i></i></span>
																</span>
															</div>
															<small id="helpId" class="text-muted">Text Color are used for category text color.</small>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Close</button>
														<button class="btn btn-primary"
															type="submit">Save</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- New Category Modal -->
		<div class="modal fade new-example-modal-right-sm" tabindex="-1" role="dialog" aria-hidden="true" id="newCategory">
				<div class="modal-dialog modal-dialog-right modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4">New Category</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><i class="fal fa-times"></i></span>
							</button>
						</div>
						<form method="POST" action="{{ route('admin.categories.store')}}" enctype="multipart/form-data">
							@csrf
							<div class="modal-body">
								<div class="form-group">
									<label for="category_name">Category Name</label>
									<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" aria-describedby="helpId">
									<small id="helpId" class="text-muted">Category name</small>
								</div>
								<div class="form-group">
									<label for="hexcolor">Hex Color</label>
									<div class="input-group" id="hexcolor">
										<input type="text"
											name="hexcolor"
											id="hexcolor"
											class="form-control"
											placeholder="Category Color"
											aria-describedby="helpId">
										<span class="input-group-append form">
											<span class="input-group-text colorpicker-input-addon"><i></i></span>
										</span>
									</div>
									<small id="helpId" class="text-muted">Hex Color are used for category color.</small>
								</div>
								<div class="form-group">
									<label for="hexcolor">Text Color</label>
									<div class="input-group" id="textcolor">
										<input type="text"
											name="textcolor"
											id="textcolor"
											class="form-control"
											placeholder="Category Text Color"
											aria-describedby="helpId">
										<span class="input-group-append form">
											<span class="input-group-text colorpicker-input-addon"><i></i></span>
										</span>
									</div>
									<small id="helpId" class="text-muted">Text Color are used for category text color.</small>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button class="btn btn-primary" type="submit">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			
        
	@endcan
@endsection

@section('scripts')
<script src="{{ asset('js/formplugins/bootstrap-colorpicker/bootstrap-colorpicker.js') }}"></script>
@parent
	<script>
		$(document).ready(function()
		{
			$('#hexcolor, #textcolor').colorpicker();
		});

	</script>

<script>
	$(document).ready(function()
	{

		// initialize datatable
		$('#dt-basic-example').dataTable(
		{
			responsive: true,
			lengthChange: false,
			dom:
				/*	--- Layout Structure 
					--- Options
					l	-	length changing input control
					f	-	filtering input
					t	-	The table!
					i	-	Table information summary
					p	-	pagination control
					r	-	processing display element
					B	-	buttons
					R	-	ColReorder
					S	-	Select

					--- Markup
					< and >				- div element
					<"class" and >		- div with a class
					<"#id" and >		- div with an ID
					<"#id.class" and >	- div with an ID and a class

					--- Further reading
					https://datatables.net/reference/option/dom
					--------------------------------------
				 */
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				/*{
					extend:    'colvis',
					text:      'Column Visibility',
					titleAttr: 'Col visibility',
					className: 'mr-sm-3'
				},*/
				{
					extend: 'pdfHtml5',
					text: 'PDF',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm mr-1'
				},
				{
					extend: 'excelHtml5',
					text: 'Excel',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm mr-1'
				},
				{
					extend: 'csvHtml5',
					text: 'CSV',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm mr-1'
				},
				{
					extend: 'copyHtml5',
					text: 'Copy',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm mr-1'
				},
				{
					extend: 'print',
					text: 'Print',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm'
				}
			]
		});

	});

</script>

@endsection
