<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-8">
			<?= form_open_multipart('user/edit'); ?>
			<input type="hidden" id="id" name="id" value="<?= $user['id']; ?>">

			<div class="row mb-2">
				<label for="email" class="col-2 col-form-label">Email</label>
				<div class="col-10">
					<input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
				</div>
			</div>

			<div class="row mb-2">
				<label for="email" class="col-2 col-form-label">Full name</label>
				<div class="col-10">
					<input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-2">Picture</div>
				<div class="col-sm-10">
					<div class="row">
						<div class="image-preview col-sm-3">
							<img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
						</div>
						<h2 class="image-panah">>></h2>
						<div class="image-preview col-sm-3" id="imagePreview">
							<img src="" alt="Image Preview" class="image-preview__image">
							<span class="image-preview__default-text">
								Image Preview
							</span>
						</div>
						<div class="col-sm-9">
							<div class="custom-file">
								<input type="hidden" id="img" name="img" value="<?= $user['image']; ?>">
								<input type="file" class="custom-file-input" id="image" name="image" onchange="profile()">
								<label class=" custom-file-label" for="image">Choose file</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group row justify-content-end">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</div>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
	const inpFile = document.getElementById('image');
	const previewContainer = document.getElementById('imagePreview');
	const previewImage = previewContainer.querySelector('.image-preview__image');
	const previewDefaultText = previewContainer.querySelector('.image-preview__default-text');

	inpFile.addEventListener("change", function() {
		const file = this.files[0];

		if (file) {
			const reader = new FileReader();

			previewDefaultText.style.display = "none";
			previewImage.style.display = "block";

			reader.addEventListener("load", function() {
				previewImage.setAttribute("src", this.result);
			});
			reader.readAsDataURL(file);
		} else {
			previewDefaultText.style.display = null;
			previewImage.style.display = null;
			previewImage.setAttribute("src", "");
		}
	});
</script>