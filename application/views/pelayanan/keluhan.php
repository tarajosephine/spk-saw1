<section class="hero-wrap hero-wrap-2 js-fullheight"
	style="background-image: url('<?= base_url(); ?>assets/frontend/images/bg_2.jpg');"
	data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<h1 class="mb-3 bread">Keluhan</h1>
				<p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url(); ?>pelayanan">Home <i
								class="ion-ios-arrow-forward"></i></a></span> <span>Keluhan <i
							class="ion-ios-arrow-forward"></i></span></p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-counter img mt-md-5" id="section-counter">
	<div class="container">
		<div class="row">
			<div class="col-md-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18 text-center py-4 bg-primary mb-4">
					<div class="text">
						<div class="icon d-flex justify-content-center align-items-center">
							<span class="flaticon-guest"></span>
						</div>
						<strong class="number" data-number="30">0</strong>
						<span>Keluhan Pelanggan</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18 text-center py-4 bg-primary mb-4">
					<div class="text">
						<div class="icon d-flex justify-content-center align-items-center">
							<span>
								<img src=" <?= base_url(); ?>assets/frontend/images/chatbot.png" height="50" width="50"
									alt="">
							</span>
						</div>
						<strong class="number" data-number="200">0</strong>
						<span>Keluhan yang sudah diproses</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18 text-center py-4 bg-primary mb-4">
					<div class="text">
						<div class="icon d-flex justify-content-center align-items-center">
							<span class="image.png">
								<img src=" <?= base_url(); ?>assets/frontend/images/global-marketing.png" height="50"
									width="50" alt="">
							</span>
						</div>
						<strong class="number" data-number="2500">0</strong>
						<span>Total Keluhan</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 justify-content-center counter-wrap ftco-animate">
				<div class="block-18 text-center py-4 bg-primary mb-4">
					<div class="text">
						<div class="icon d-flex justify-content-center align-items-center">
							<span class="flaticon-idea"></span>
						</div>
						<strong class="number" data-number="40">0</strong>
						<span>Topik</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section testimony-section ftco-no-pt">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<h2 class="mb-3">Form Keluhan</h2>
			</div>
		</div>
		<div class="row ftco-animate">
			<div class="col-md-12">

				<!-- Modal Tambah Keluhan -->
				<div id="tambahKeluhanModal" tabindex="-1" role="dialog" aria-labelledby="UsahaModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="UsahaModalLabel">Form Keluhan</h5>
								<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close"></button>
							</div>
							<form method="post">
								<input type="hidden" name="id_tu" id="id_tu">
								<div class="card-body">
									<div id="progressbarwizard">

										<ul class="nav nav-pills nav-justified form-wizard-header mb-3">
											<li class="nav-item">
												<a href="#usaha" data-bs-toggle="tab" data-toggle="tab"
													class="nav-link rounded-0 pt-2 pb-2">
													<i class="mdi mdi-account me-1"></i>
													<span class="d-none d-sm-inline">Pelanggan</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="#jp" data-bs-toggle="tab" data-toggle="tab"
													class="nav-link rounded-0 pt-2 pb-2">
													<i class="mdi mdi-file-document me-1"></i>
													<span class="d-none d-sm-inline">Keluhan</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="#finish" data-bs-toggle="tab" data-toggle="tab"
													class="nav-link rounded-0 pt-2 pb-2">
													<i class="mdi mdi-checkbox-marked-circle-outline me-1 text-success"></i>
													<span class="d-none d-sm-inline">Finish</span>
												</a>
											</li>
										</ul>

										<div class="tab-content b-0 mb-0">

											<div id="bar" class="progress mb-3" style="height: 7px;">
												<div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
												</div>
											</div>

											<!-- DATA 1 -->
											<!-- ################################################################################################################################# -->
											<div class="tab-pane" id="usaha">
												<div class="row">
													<div class="col-12">

														<div class="form-floating mb-2">
															<label for="form-control">Nomer CID</label>
															<input type="text" class="form-control" name="cid" id="floatingCID"
																placeholder="Masukan CID" />
														</div>

														<div class="datanePelanggan"></div>

													</div> <!-- end col -->
												</div> <!-- end row -->
											</div>

											<!-- DATA 2 -->
											<!-- ################################################################################################################################# -->
											<div class=" tab-pane" id="jp">
												<div class="row">
													<div class="col-12">
														<div class="form-floating mb-2">
															<label for="form-control">Optional Keluhan</label>
															<select class="form-control" id="floatingjp" name="jp"
																aria-label="Floating label select example">
																<option selected>Pilih Keluhan</option>
																<option value="taki">Tidak Ada Koneksi Internet</option>
																<option value="takilmm">Tidak Ada Koneksi Internet Lampu Modem Merah
																</option>
																<option value="il">Internet Lambat</option>
																<option value="its">Internet Tidak Stabil</option>
																<option value="tbbwt">Tidak Bisa Buka Web Tertentu</option>
																<option value="wl">Wifi Lambat</option>
																<option value="wts">Wifi Tidak Stabil</option>
																<option value="wta">Wifi Tidak Ada</option>
																<option value="wtbnkk">Wifi Tidak Bisa Nyambung Ke Komputer</option>
																<option value="wtbnkh">Wifi Tidak Bisa Nyambung Ke HP</option>
																<option value="wtbnpl">Wifi Tidak Bisa Nyambung Perangkat Lain
																</option>
																<option value="stta">Siaran TV Tidak Ada</option>
																<option value="sttsm">Siaran TV Tidak Stabil Muter</option>
																<option value="sttbkct">Siaran TV Tidak Bisa Ke Channel Tertentu
																</option>
																<option value="o">Others</option>
															</select>
														</div>

														<div class="row mb-3">
															<label class="col-md-3 col-form-label" for="userName1">Upload Foto
																Perangkat</label>
															<div class="col-md-9">
																<div class="form-group row">
																	<div class="col-sm-12">
																		<div class="row">
																			<div class="image-preview col-sm-8" id="imagePreview_1">
																				<img src="" alt="Image Preview" id="img1"
																					class="image-preview__image img-thumbnail input_data_1">
																				<span
																					class="image-preview__default-text text_input_data_1">
																					Image Preview
																				</span>
																			</div>
																			<input type="hidden" id="img_1" name="img_1">
																			<div class="col-sm-12">
																				<div class="custom-file">
																					<input type="file" id="image_1" name="image_1"
																						class="form-control">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div> <!-- end col -->
													<div class="data-form-jp"></div>
												</div> <!-- end row -->
											</div>

											<div class="tab-pane" id="finish">
												<div class="row">
													<div class="col-12">
														<div class="text-center">
															<h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
															<h3 class="mt-0">Terima Kasih !</h3>

															<p class="w-75 mb-2 mx-auto">Jika ada data Komplain yang
																kosong, anda Harus di
																isi data tersebut.</p>

															<div class="mb-3">
																<div class="form-check d-inline-block">
																	<input type="checkbox" class="form-check-input"
																		id="customCheck3">
																	<label class="form-check-label" for="customCheck3">Saya setuju
																		upload data ini selesai</label>
																</div>
															</div>
														</div>
													</div> <!-- end col -->
													<div class="col-9"></div>
													<div class="col-3 mb-3">
														<button type="button" class="btn btn-secondary align-items-end"
															data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-primary align-items-end">Kirim</button>
													</div>
												</div> <!-- end row -->
											</div>

											<ul class="list-inline mb-0 wizard modal-footer">
												<li class="previous list-inline-item">
													<a href="#" class="btn btn-info">Previous</a>
												</li>
												<li class="next list-inline-item float-end">
													<a href="#" class="btn btn-info">Next</a>
												</li>
											</ul>

										</div> <!-- tab-content -->
									</div> <!-- end #progressbarwizard-->
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section-parallax ftco-section ftco-no-pt">
	<div class="parallax-img d-flex align-items-center">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 col-lg-7 text-center heading-section ftco-animate">
					<h2>Subcribe to our Newsletter</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
						live the blind texts. Separated they live in</p>
					<div class="row d-flex justify-content-center mt-4 mb-4">
						<div class="col-md-8">
							<form action="#" class="subscribe-form">
								<div class="form-group d-flex">
									<input type="text" class="form-control" placeholder="Enter email address">
									<input type="submit" value="Subscribe" class="submit px-3">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</section>
