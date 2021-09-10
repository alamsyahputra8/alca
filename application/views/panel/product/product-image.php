<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<link href="https://parwatha.com/polo/css/style.css" rel="stylesheet">
<link href="https://parwatha.com/polo/css/responsive.css" rel="stylesheet">
<?PHP
$q 				= "
				select * from product where id_product='$id'
				";
$getDataP		= $this->query->getDatabyQ($q);
$dataP 			= array_shift($getDataP);
?>
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div id="gagalinsert" class="alert alert-warning alert-elevate kt-hidden" role="alert" style="z-index: 1!important;">
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

	<div id="suksesinsert" class="alert alert-success fade show kt-hidden" role="alert" style="z-index: 1!important;">
		<div class="alert-icon"><i class="flaticon-black"></i></div>
		<div class="alert-text">Success!</div>
		<div class="alert-close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="la la-close"></i></span>
			</button>
		</div>
	</div>

	<div id="suksesdelete" class="alert alert-secondary fade show kt-hidden" role="alert" style="z-index: 1!important;">
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
					Product Image of : <b><?PHP echo $dataP['name']; ?></b>
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<!--a href="#" class="btn btn-default btn-icon-sm">
							<i class="la la-download"></i> Export
						</a-->
						&nbsp;
						<?PHP echo getRoleInsert($akses,'addnewfac','Add New Image');?>
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
									<h3 class="kt-portlet__head-title">Add New Photos</h3>
								</div>
							</div>
							<div class="kt-portlet__body">
								<div class="form-group row">
									<input type="hidden" id="idproduct" name="idproduct" value="<?PHP echo $id; ?>">
									<label class="col-form-label col-lg-3 col-sm-12">Product Photo</label>
									<div class="col-lg-4 col-md-9 col-sm-12">
										<div class="kt-dropzone dropzone m-dropzone--primary" action="<?PHP echo base_url(); ?>core/uploadProductImgMore/<?PHP echo $id; ?>" id="m-dropzone-two">
											<div class="kt-dropzone__msg dz-message needsclick">
												<h3 class="kt-dropzone__msg-title">Drop files here or click to upload.</h3>
												<span class="kt-dropzone__msg-desc">Upload up to 10 files</span>
											</div>
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

		<div class="kt-portlet__body">

			<section id="page-content" class="" style="padding-top: 0px;">
	            <div class="container">

	                <!-- Portfolio -->
	                <div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="20" style="min-height: 300px!important;">
		                <?PHP
		                $dataRolesAll		= $this->query->getData('product_image','*',"where id_product='$id' and cover!=1 ORDER BY id_image");
						$x 					= 0;

						$cek				= $this->query->getNumRows('product_image','*',"where id_product='$id' and cover!=1")->num_rows();

						if ($cek>0) {
							//echo '<div id="portfolio" class="grid-layout portfolio-4-columns" data-margin="20">';
							foreach($dataRolesAll as $data) { $x++;
								$id 		= $data['id_image'];
								$picture 	= $data['file'];

								echo '
				                    <div class="portfolio-item img-zoom ct-foto">
				                        <div class="portfolio-item-wrap">
				                            <div class="portfolio-image">
				                                <a href="#"><img src="'.base_url().'images/product/'.$picture.'" alt=""></a>
				                            </div>
				                            <div class="portfolio-description">
				                                <a title="Sample Photo" data-lightbox="image" href="'.base_url().'images/product/'.$picture.'">
				                                    <i class="fa fa-expand"></i>
				                                </a>
				                                <a title="Delete" class="btndeleteMenu" data-toggle="modal" data-target="#delete" data-id="'.$id.'">
				                                    <i class="fa fa-times"></i>
				                                </a>
				                            </div>
				                        </div>
				                    </div>
								';
							}
							//echo '</div>';
						} else {
							echo '
								<div class="row" style="padding: 20px;">
			                        <div class="col-sm-12">
			                            <div><center><img src="'.base_url().'images/icon/notfound.png"></center></div><br>
			                            <h5 class="text-center">Anda Belum Memiliki Data Tersimpan Di Website Anda</h5>
			                            </h6><center>Silahkan buat data baru</center></h6><br>
			                        </div>
			                    </div>
			                ';
						}
		                ?>
	            	</div>
	                
	            </div>
	        </section>
	        <!-- end: Content -->

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
<!--Plugins-->
<!--script src="<?PHP echo base_url(); ?>assets/polo/js/jquery.js"></script-->
<script src="https://parwatha.com/polo/js/plugins.js"></script>

<!--Template functions-->
<script src="https://parwatha.com/polo/js/functions.js"></script>