<?PHP
$userdata 	= $this->session->userdata('sesspwt'); 
$userid 	= $userdata['userid'];
$q 			= "select * from user where userid='$userid'";
$getUser 	= $this->query->getDatabyQ($q);
$dataUser	= array_shift($getUser);

if ($dataUser['picture']=='') {
	$hidden 	= 'kt-hidden';
} else {
	$hidden 	= '';
}
?>
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

	<!-- begin:: Header Menu -->
	<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
	<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
		<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
			<ul class="kt-menu__nav ">
				
			</ul>
		</div>
	</div>

	<!-- end:: Header Menu -->

	<!-- begin:: Header Topbar -->
	<div class="kt-header__topbar">
		
		<!--begin: Quick panel toggler -->
		<div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="Notifications" data-placement="right" style="display: none;">
			<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand" id="kt_quick_panel_toggler_btn">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
				    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" id="Combined-Shape" fill="#000000"/>
				        <rect id="Rectangle-23" fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
				    </g>
				</svg>  <span class="kt-pulse__ring"></span>
			</span>
		</div>

		<!--end: Quick panel toggler -->


		<!--begin: User Bar -->
		<div class="kt-header__topbar-item kt-header__topbar-item--user">
			<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
				<div class="kt-header__topbar-user">
					<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
					<span class="kt-header__topbar-username kt-hidden-mobile"><?PHP echo $dataUser['name']; ?></span>
					<img class="<?PHP echo $hidden; ?>" alt="Pic" src="<?PHP echo base_url(); ?>images/user/<?PHP echo $dataUser['picture']; ?>" />

					<?PHP if ($dataUser['picture']=='') { ?>
					<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
					<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?PHP echo substr($dataUser['name'],0,1); ?></span>
					<?PHP } ?>
				</div>
			</div>
			<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

				<!--begin: Head -->
				<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?PHP echo base_url(); ?>assets/theme/assets/media/misc/bg-1.jpg)">
					<div class="kt-user-card__avatar">
						<img class="<?PHP echo $hidden; ?>" alt="Pic" src="<?PHP echo base_url(); ?>images/user/<?PHP echo $dataUser['picture']; ?>" />

						<?PHP if ($dataUser['picture']=='') { ?>
						<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
						<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?PHP echo substr($dataUser['name'],0,1); ?></span>
						<?PHP } ?>
					</div>
					<div class="kt-user-card__name">
						<?PHP echo $dataUser['name']; ?>
					</div>
					<div class="kt-user-card__badge">
						
					</div>
				</div>

				<!--end: Head -->

				<!--begin: Navigation -->
				<div class="kt-notification">
					<a href="<?PHP echo base_url(); ?>panel/userprofile" class="kt-notification__item">
						<div class="kt-notification__item-icon">
							<i class="flaticon2-calendar-3 kt-font-success"></i>
						</div>
						<div class="kt-notification__item-details">
							<div class="kt-notification__item-title kt-font-bold">
								My Profile
							</div>
							<div class="kt-notification__item-time">
								Account settings and more
							</div>
						</div>
					</a>
					<!--a href="#" class="kt-notification__item">
						<div class="kt-notification__item-icon">
							<i class="flaticon2-rocket-1 kt-font-danger"></i>
						</div>
						<div class="kt-notification__item-details">
							<div class="kt-notification__item-title kt-font-bold">
								My Activities
							</div>
							<div class="kt-notification__item-time">
								Logs and notifications
							</div>
						</div>
					</a-->
					<div class="kt-notification__custom">
						<a href="<?PHP echo base_url(); ?>panel/logout" class="btn btn-label-brand btn-sm btn-bold">Sign Out</a>
					</div>
				</div>

				<!--end: Navigation -->
			</div>
		</div>

		<!--end: User Bar -->
	</div>

	<!-- end:: Header Topbar -->
</div>