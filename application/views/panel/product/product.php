<?PHP
$qT 				= "
					select a.*, (select menu from menu_site where id_menu=a.id_menu) menu
					from product_type a
					order by id_menu, sort asc
					";
$getDataType		= $this->query->getDatabyQ($qT);
$qBrand 			= "
					select * 
					from link 
					order by title asc
					";
$getDataBrand		= $this->query->getDatabyQ($qBrand);
?>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div id="gagalinsert" class="alert alert-warning alert-elevate kt-hidden" role="alert">
		<div class="alert-icon"><i class="flaticon-warning"></i></div>
		<div class="alert-text">
			<strong>Failed!</strong> Change a few things up and try submitting again.
		</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="la la-close"></i></span>
			</button>
		</div>
	</div>

	<div id="suksesinsert" class="alert alert-success fade show kt-hidden" role="alert">
		<div class="alert-icon"><i class="flaticon-black"></i></div>
		<div class="alert-text">Success!</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="la la-close"></i></span>
			</button>
		</div>
	</div>

	<div id="suksesdelete" class="alert alert-secondary fade show kt-hidden" role="alert">
		<div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
		<div class="alert-text">Your data has been deleted!</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="la la-close"></i></span>
			</button>
		</div>
	</div>

	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
				</span>
				<h3 class="kt-portlet__head-title">
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<!--a href="#" class="btn btn-default btn-icon-sm">
							<i class="la la-download"></i> Export
						</a-->
						&nbsp;
						<?PHP echo getRoleBtnAction($akses,'configdiskon','Discount Configuration','diskon','btn-dark','la la-cog');?>
						<?PHP echo getRoleInsert($akses,'addnewfac','Add New Product');?>
					</div>
				</div>
			</div>
		</div>

		<!-- MODAL INSERT -->
		<div class="modal fade" id="addnewfac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<!--div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						</button>
					</div-->

					<form class="kt-form kt-form--label-right" id="forminsert" enctype="multipart/form-data">
						<div class="modal-body kt-portlet kt-portlet--tabs" style="margin-bottom: 0px;">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title">Add New Product</h3>
								</div>
							</div>
							<div class="kt-portlet__body">
								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12"></label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<label class="kt-checkbox">
											<input type="checkbox" name="popular" id="popular" value="1"> <b>Set as Popular Product</b>
											<span></span>
										</label>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Product Cover *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<input type="file" name="pict" class="form-control" id="pict" placeholder="Cover">
										</div>
										<span class="form-text text-muted">Untuk tampilan lebih maksimal, ukuran gambar disarankan tidak lebih dari 2MB.</span>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Product Photo</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class="kt-dropzone dropzone m-dropzone--primary" action="<?PHP echo base_url(); ?>core/uploadProductImg" id="m-dropzone-two">
											<div class="kt-dropzone__msg dz-message needsclick">
												<h3 class="kt-dropzone__msg-title">Drop files here or click to upload.</h3>
												<span class="kt-dropzone__msg-desc">Upload up to 10 files</span>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Name *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<input type="text" name="name" class="form-control" id="name" placeholder="Name">
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Link Marketplace *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<input type="text" name="linkmp" class="form-control" id="linkmp" placeholder="Link Marketplace">
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Price *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
											<input type="number" name="price" class="form-control" id="price" placeholder="Price">
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Discount</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
											<input type="number" name="disc" class="form-control" id="disc" placeholder="Discount">
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Discount Multiple Item</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
											<input type="number" name="disc2" class="form-control" id="disc2" placeholder="Discount Multiple Item">
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Weight *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<input type="number" name="weight" class="form-control" placeholder="Weight" id="weight" aria-describedby="basic-addon1">
											<div class="input-group-prepend"><span class="input-group-text">KG</span></div>
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Brand *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<select name="brand" class="form-control select2norm" id="brand" placeholder="Brand" style="width: 100%;">
												<option value=""></option>
												<?PHP foreach ($getDataBrand as $data) { ?>
													<option value="<?PHP echo $data['id_link']; ?>"><?PHP echo $data['title']; ?></option>
												<?PHP } ?>
											</select>
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Category *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<select name="category" class="form-control select2norm" id="category" placeholder="Menu" style="width: 100%;">
												<option value=""></option>
												<?PHP foreach ($getDataType as $dataT) { $idtype = $dataT['id_type']; ?>
													<optgroup label="<?PHP echo $dataT['menu']; ?> - <?PHP echo $dataT['name']; ?>">
														<?PHP
														$q 					= "
																			select *
																			from product_category
																			where id_type='$idtype' order by 1 asc
																			";
														$getDataCategory	= $this->query->getDatabyQ($q);
														foreach ($getDataCategory as $data) { 
														?>
														<option value="<?PHP echo $data['id_category']; ?>"><?PHP echo $data['name']; ?></option>
														<?PHP } ?>
													</optgroup>
												<?PHP } ?>
											</select>
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Size</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">ALL SIZE</span></div>
											<input type="number" name="stockA" class="form-control" placeholder="Stock" id="stockA" aria-describedby="basic-addon1">
										</div>
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">S</span></div>
											<input type="number" name="stockS" class="form-control" placeholder="Stock" id="stockS" aria-describedby="basic-addon1">
										</div>
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">M</span></div>
											<input type="number" name="stockM" class="form-control" placeholder="Stock" id="stockM" aria-describedby="basic-addon1">
										</div>
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">L</span></div>
											<input type="number" name="stockL" class="form-control" placeholder="Stock" id="stockL" aria-describedby="basic-addon1">
										</div>
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">XL</span></div>
											<input type="number" name="stockXL" class="form-control" placeholder="Stock" id="stockXL" aria-describedby="basic-addon1">
										</div>
										<div class='input-group'>
											<div class="input-group-prepend"><span class="input-group-text">XXL</span></div>
											<input type="number" name="stockXXL" class="form-control" placeholder="Stock" id="stockXXL" aria-describedby="basic-addon1">
										</div>
										<span class="form-text text-muted">Kosongkan jika ukuran tidak tersedia.</span>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Description *</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<div class='input-group'>
											<textarea name="description" class="form-control summernote" id="description"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" id="saveinsert" class="btn btn-primary">Save</button>
						</div>
					</form>

				</div>
			</div>
		</div>
		<!-- END MODAL INSERT -->

		<!-- MODAL DISKON -->
		<div class="modal fade" id="configdiskon" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">

					<form class="kt-form kt-form--label-right" id="formconf" enctype="multipart/form-data">
						<div class="modal-body kt-portlet kt-portlet--tabs" style="margin-bottom: 0px;">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title">Discount Configuration</h3>
								</div>
							</div>
							<div class="kt-portlet__body">

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Brand *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<select name="brand" class="form-control select2norm" id="confbrand" placeholder="Brand" style="width: 100%;">
												<option value=""></option>
												<?PHP foreach ($getDataBrand as $data) { ?>
													<option value="<?PHP echo $data['id_link']; ?>"><?PHP echo $data['title']; ?></option>
												<?PHP } ?>
											</select>
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-lg-3 col-sm-12">Discount *</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class='input-group'>
											<input type="number" name="disc" class="form-control" id="confdisc" placeholder="Discount">
										</div>
										<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" id="saveconf" class="btn btn-primary">Save</button>
						</div>
					</form>

				</div>
			</div>
		</div>
		<!-- END MODAL DISKON -->

		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="tabledata">
				<thead>
					<tr>
						<th>COVER</th>
						<th>NAME</th>
						<th>TYPE</th>
						<th>CATEGORY</th>
						<th>BRAND</th>
						<th>PRICE</th>
						<th>POPULAR</th>
						<th>UPDATE BY</th>
						<th>LAST UPDATE</th>
						<th>ACTIONS</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>COVER</th>
						<th>NAME</th>
						<th>TYPE</th>
						<th>CATEGORY</th>
						<th>BRAND</th>
						<th>PRICE</th>
						<th>POPULAR</th>
						<th>UPDATE BY</th>
						<th>LAST UPDATE</th>
						<th>ACTIONS</th>
					</tr>
				</tfoot>
			</table>
			<!--end: Datatable -->

			<!-- MODAL UPDATE -->
			<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<!--div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Update Data : <b id="nameroles"></b></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							</button>
						</div-->

						<form class="kt-form kt-form--label-left" id="formupdate" enctype="multipart/form-data">
							<div class="modal-body kt-portlet kt-portlet--tabs" style="margin-bottom: 0px;">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">Update Data : <b id="namedata"></b></h3>
									</div>
								</div>
								<div class="kt-portlet__body">
									<input type="hidden" name="ed_id" class="form-control" id="ed_id">

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12"></label>
										<div class="col-lg-9 col-md-9 col-sm-12">
											<label class="kt-checkbox">
												<input type="checkbox" name="ed_popular" value="1" id="ed_popular"> <b>Set as Popular Product</b>
												<span></span>
											</label>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Product Cover *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<input type="file" name="upl" class="form-control" id="upl" placeholder="Cover">
											</div>
											<span class="form-text text-muted"><b class="text-danger">Kosongkan jika tidak akan merubah gambar.</b> Untuk tampilan lebih maksimal, ukuran gambar disarankan tidak lebih dari 2MB.</span>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Name *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<input type="text" name="ed_name" class="form-control" id="ed_name" placeholder="Name">
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Link Marketplace *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<input type="text" name="ed_linkmp" class="form-control" id="ed_linkmp" placeholder="Link Marketplace">
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Price *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
												<input type="number" name="ed_price" class="form-control" id="ed_price" placeholder="Price">
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Discount</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
												<input type="number" name="ed_disc" class="form-control" id="ed_disc" placeholder="Discount">
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Discount Multiple Item</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
												<input type="number" name="ed_disc2" class="form-control" id="ed_disc2" placeholder="Discount Multiple Item">
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Weight *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<input type="number" name="ed_weight" class="form-control" placeholder="Weight" id="ed_weight" aria-describedby="basic-addon1">
												<div class="input-group-prepend"><span class="input-group-text">KG</span></div>
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Brand *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<select name="ed_brand" class="form-control select2norm" id="ed_brand" placeholder="Brand" style="width: 100%;">
													<option value=""></option>
													<?PHP foreach ($getDataBrand as $data) { ?>
														<option value="<?PHP echo $data['id_link']; ?>"><?PHP echo $data['title']; ?></option>
													<?PHP } ?>
												</select>
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Category *</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<select name="ed_category" class="form-control select2norm" id="ed_category" placeholder="Menu" style="width: 100%;">
													<option value=""></option>
													<?PHP foreach ($getDataType as $dataT) { $idtype = $dataT['id_type']; ?>
														<optgroup label="<?PHP echo $dataT['menu']; ?> - <?PHP echo $dataT['name']; ?>">
															<?PHP
															$q 					= "
																				select *
																				from product_category
																				where id_type='$idtype' order by 1 asc
																				";
															$getDataCategory	= $this->query->getDatabyQ($q);
															foreach ($getDataCategory as $data) { 
															?>
															<option value="<?PHP echo $data['id_category']; ?>"><?PHP echo $data['name']; ?></option>
															<?PHP } ?>
														</optgroup>
													<?PHP } ?>
												</select>
											</div>
											<!-- <span class="form-text text-muted">Tambahkan <b><code>&ltbr&gt</code></b> jika ingin menambahkan "Enter" atau baris baru.</span> -->
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Size</label>
										<div class="col-lg-4 col-md-9 col-sm-12">
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">ALL SIZE</span></div>
												<input type="number" name="ed_stockA" class="form-control" placeholder="Stock" id="ed_stockA" aria-describedby="basic-addon1">
											</div>
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">S</span></div>
												<input type="number" name="ed_stockS" class="form-control" placeholder="Stock" id="ed_stockS" aria-describedby="basic-addon1">
											</div>
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">M</span></div>
												<input type="number" name="ed_stockM" class="form-control" placeholder="Stock" id="ed_stockM" aria-describedby="basic-addon1">
											</div>
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">L</span></div>
												<input type="number" name="ed_stockL" class="form-control" placeholder="Stock" id="ed_stockL" aria-describedby="basic-addon1">
											</div>
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">XL</span></div>
												<input type="number" name="ed_stockXL" class="form-control" placeholder="Stock" id="ed_stockXL" aria-describedby="basic-addon1">
											</div>
											<div class='input-group'>
												<div class="input-group-prepend"><span class="input-group-text">XXL</span></div>
												<input type="number" name="ed_stockXXL" class="form-control" placeholder="Stock" id="ed_stockXXL" aria-describedby="basic-addon1">
											</div>
											<span class="form-text text-muted">Kosongkan jika ukuran tidak tersedia.</span>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-form-label col-lg-3 col-sm-12">Description *</label>
										<div class="col-lg-9 col-md-9 col-sm-12">
											<div class='input-group'>
												<textarea name="ed_description" class="form-control summernote" id="ed_description"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" id="saveupdate" class="btn btn-primary">Save</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<!-- END MODAL UPDATE -->

			<!-- MODAL DELETE -->
			<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" style="display: flex;">
							<div class="swal2-header">
								<div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"></div>
								<h2 class="swal2-title" id="swal2-title" style="display: flex;">Are you sure?</h2>
							</div>
							<div class="swal2-content">
								<div id="swal2-content" style="display: block;">You won't be able to revert this!</div>
							</div>
							<div class="swal2-actions" style="display: flex;">
								<form method="POST">
								<input type="hidden" name="iddel" id="iddel" value="">
								<center>
								<button type="button" id="deleteBtn" class="swal2-confirm swal2-styled" aria-label="" style="border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">
									Yes, delete it!
								</button>
								<button type="button" class="swal2-cancel swal2-styled" data-dismiss="modal">Cancel</button>
								</center>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MODAL DELETE -->
		</div>
	</div>
</div>
<!-- end:: Content -->