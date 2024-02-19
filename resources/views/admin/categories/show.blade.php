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
				<h2>
					<i class="subheader-icon fal fa-ballot-check mr-1"></i>
					<span>
						<i class="fw-300 mr-1">All Posts in</i>
						<span style="color: {{$category->hexcolor}};">{{$category->name}}</span> Category
					</span>
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div>
						<table id="datatable" class="table table-bordered table-hover table-striped w-100">
							<thead class="bg-primary-600">
								<tr>
									<th>Post Title</th>
									<th>Author</th>
									<th>Created at</th>
									<th>Published at</th>
									<th>Last Update</th>
								</tr>
							</thead>
							<tbody>
								@if ($posts->count()>0)
								@foreach ($posts as $post)
								<tr>
									<td> <a href="{{ route('admin.posts.show', $post->id) }}" class="fw-500">{{$post->title}}</a> </td>
									<td> {{$post->user->name}} </td>
									<td> {{$post->created_at}} </td>
									<td> {{$post->published_at}} </td>
									<td> {{$post->updated_at}} </td>
								</tr>
								@endforeach
								@else
									<tr>
										<td class="text-center text-danger fw-400 fs-xxl" colspan="5">
											No Post Available for this Category
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
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

		// initialize datatable
		$('#datatable').dataTable(
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
