@extends('template')

@section('title', 'Student')

@section('content')

<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">@yield('title')</h4>
	</div>
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="/dashboard">Home</a></li>
			<li>@yield('title')</li>
		</ol>
	</div>
</div>

<form action="/student" method="post" id="form">
	<button class="btn btn-danger m-b-20 btn-delete" type="button">Hapus</button>
	@csrf
	@method('delete')
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable">
					<thead>
						<tr>
							<th><input type="checkbox" id="check" name="chk[]"></th>
							<th>Student</th>
							<th>NIM</th>
							<th>Class</th>
							<th>Category</th>
							<th>Whatsapp</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($user as $u)
						<tr>
							<th><input type="checkbox" name="check[]" value="{!! $u->id !!}"></th>
							<td>{!! $u->name !!}</td>
							<td>{!! $u->nim !!}</td>
							<td>{!! $u->classes->class !!}</td>
							<td>{!! $u->category->category !!}</td>
							<td><a href="//wa.me/{!! $u->whatsapp !!}" target="_blank">{!! $u->whatsapp !!}</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>

<script>
	$(document).ready(function(){
		$("#check").click(function(){
			if($(this).is(":checked"))
				$("[type='checkbox']").prop("checked", true);
			else
				$("[type='checkbox']").prop("checked", false);
		});

		$(".btn-delete").click(function(){
			swal({
				title: "Apakah anda yakin?",
				text: "Data ini akan dihapus!",
				icon: "warning",
				buttons: {
					cancel: "Batal",
					danger: {
						text: "Hapus",
					}
				},
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$("#form").submit();
				} else {
					swal("Ooops", "Data tidak jadi dihapus!", "error");
				}
			});
		});

		$("#dataTable").DataTable({
			"ordering": false
		})
	});
</script>

@endsection()