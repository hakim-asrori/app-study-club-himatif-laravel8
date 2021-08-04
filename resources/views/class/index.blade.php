@extends('template')

@section('title', 'Class')

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

<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label for="class">Add @yield('title')</label>
					<input type="text" id="class" class="form-control" placeholder="Format : D3TI.1C">
				</div>
				<button id="add" class="btn btn-success">Add</button>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="dataTable">
						<thead>
							<tr>
								<th>Class</th>
								<th>Student</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	load();

	function load() {
		let empTable = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
		empTable.innerHTML = "";

		$.ajax({
			url: "/class/get",
			type: "get",
			success: function (response) {
				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						let NewRow = empTable.insertRow(0); 
						let classCell = NewRow.insertCell(0); 
						let studentCell = NewRow.insertCell(1); 
						let opsiCell = NewRow.insertCell(2); 

						classCell.innerHTML = val['class']; 
						studentCell.innerHTML = '<span class="badge badge-success" style="text-transform: lowercase;">'+val['user']+' Students</span>';
						if (val['id'] != 1) {
							opsiCell.innerHTML = '<button onclick="hapus('+ val['id'] +')" class="btn btn-danger">Hapus</button>';
						} 
					}
				}
			}
		});
	}

	function hapus(Class) {
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
				$.ajax({
					url: "/class/del",
					type: "post",
					data: {class: Class},
					success: function (response) {
						if (response == 1) {
							swal("Selamat!", "Data anda berhasil dihapus", "success");
							load();
						} else if (response == 2) {
							$("#pesan").html(swal('Ooops!', 'Data ini tidak boleh dihapus!', 'error'));
						} else {
							swal("Ooops", "Data gagal terhapus!", "error");
						}
					}
				});
			} else {
				swal("Ooops", "Data tidak jadi dihapus!", "error");
			}
		});
	}

	$(document).ready(function () {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$("#add").on("click", function () {
			let Class = $("#class").val().trim();

			if (Class != '') {
				$.ajax({
					url: "/class/add",
					type: "post",
					data: {class: Class},
					success: function (response) {
						if (response == 1) {
							$("#pesan").html(swal('Wooww!', 'Data berhasil di input!', 'success'));
							$("#class").val('')
							load();
						} else {
							$("#pesan").html(swal('Ooops!', 'Data gagal di input!', 'error'));
						}
					}
				});
			} else {
				$("#pesan").html(swal('Ooops!', 'Kelas tidak boleh kosong!', 'error'));
			}
		})

	})
</script>

@endsection()