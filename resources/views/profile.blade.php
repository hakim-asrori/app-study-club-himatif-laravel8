@extends('template')

@section('title', 'Profile')

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
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-2" style="display: flex; justify-content: center">
				<a href="" data-toggle="modal" data-target="#ubahProfil">
					<img src="<?= $user->image != 'default.jpg' ? '/assets/img/profile/'.$user->image : '/assets/img/profile/'.$user->image ?>" alt="<?= $user->name ?>" width="150" height="150">
				</a>
			</div>
			<div class="col-lg-10">
				<form action="/profile" onsubmit="return false;" id="form" method="post">
					@csrf
					@method('patch')
					<div class="form-group">
						<label for="nim">NIM</label>
						<input type="number" class="form-control" value="{{ $user->nim }}" name="nim">
					</div>
					<div class="form-group">
						<label for="name">Nama Lengkap</label>
						<input type="text" class="form-control" value="{{ $user->name }}" name="name">
					</div>
					<div class="form-group">
						<label for="class">Kelas</label>
						<select name="class" id="class" class="form-control">
							@foreach ($class as $c)
							<option value="<?= $c->id ?>" <?= ($c->id == $user->id_class) ? 'selected' : '' ?>><?= $c->class ?></option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control" disabled value="{{ $user->email }}">
					</div>

					<div class="form-group">
						<button class="btn btn-success" name="simpan">Simpan</button>
						<input type="reset" class="btn btn-warning" value="Reset">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ubahProfil" tabindex="-1" aria-labelledby="ubahProfilLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ubahProfilLabel">Ubah Foto Profil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/profil/image" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label>Upload Foto</label>
						<input type="file" name="image" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
					<button  class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('button[name="simpan"]').on('click', function () {
			let nama = $('input[name="nama"]').val();
			let nim = $('input[name="nim"]').val();

			if (nim == '' && nama == '') {
				$("#pesan").html(swal('Ooops!', 'NIM dan Nama tidak boleh kosong!', 'error'));
			} else if (nim == '') {
				$("#pesan").html(swal('Ooops!', 'NIM tidak boleh kosong!', 'error'));
			} else if (nama == '') {
				$("#pesan").html(swal('Ooops!', 'Nama tidak boleh kosong!', 'error'));
			} else {
				document.getElementById('form').onsubmit = false;
			}
		})
	})
</script>


@endsection()