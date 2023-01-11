@extends('layouts.master')
    @section("content")
        @include("website.navbar");
<div class="contact-us-section section-spacing bg-gray">
				<div class="container">
					<div class="theme-title-one">
						<h2>Apply Form</h2>
					</div> <!-- /.theme-title-one -->
					<div class="clearfix no-gutters row">
					<div class="col-lg-3 col-12"></div>
					<div class="col-lg-6 col-12">
						<div class="main-content">
							<div class="form-wrapper">
								<form action="{{route('contactstore')}}" method="POST" class="theme-form-one form-validation" autocomplete="on" enctype='multipart/form-data'>
									@csrf	
									<div class="row">
										<div class="col-sm-6 col-12"><input type="text" placeholder="Name *" name="name" required></div>
										<div class="col-sm-6 col-12"><input type="number" placeholder="Phone *" name="number" required></div>
										<div class="col-sm-6 col-12"><input type="email" placeholder="Email *" name="email"></div>
                                        <div class="col-sm-6 col-12"><input type="text" placeholder="Applying For *" name="apply_for" value="{{$job_detail->caption ?? ''}}"></div>
                                        <div class="col-sm-12 col-12"><input type="text" placeholder="Country" name="country" value="{{$job_detail->getJob->country ?? ''}}"></div>
                                        <div class="col-sm-6 col-12"><input type="file" name="file"></div>
										<div class="col-12"><textarea placeholder="If any Question..." name="message"></textarea></div>
										<input type="hidden" name="job_id" value="{{$job_detail->getJob ?? ''}}">
									</div> <!-- /.row -->
									<button class="theme-button-one">SUBMIT</button>
								</form>
							</div> <!-- /.form-wrapper -->
						</div> <!-- /.col- -->
					</div> <!-- /.main-content -->
					</div>
				</div> <!-- /.container -->

				<!--Contact Form Validation Markup -->
				<!-- Contact alert -->
				<div class="alert-wrapper" id="alert-success">
					<div id="success">
						<button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
						<div class="wrapper">
			               	<p>Your message was sent successfully.</p>
			             </div>
			        </div>
			    </div> <!-- End of .alert_wrapper -->
			    <div class="alert-wrapper" id="alert-error">
			        <div id="error">
			           	<button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
			           	<div class="wrapper">
			               	<p>Sorry!Something Went Wrong.</p>
			            </div>
			        </div>
			    </div> <!-- End of .alert_wrapper -->
			</div> <!-- /.contact-us-section -->
@include("website.company_partner")
@endsection
