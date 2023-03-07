@extends('master')

@section('body')

    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>{{__('messages.ContactUs')}}</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- about_area_start -->
    <div class="contactRow">
        <div class="col-12">
            <h2 class="contact-title">{{__('messages.ContactGet')}}</h2>
        </div>
        <div class="col-lg-8">
            <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                @csrf 
                <div class="contactRow">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" required placeholder=" Message"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input required class="form-control valid" name="name" id="name" type="text" required placeholder="Enter your name"  >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control valid" name="email" id="email" type="email" required placeholder="Email">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input class="form-control" name="subject" id="subject" type="text" required placeholder="Enter Subject">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="button button-contactForm boxed-btn">{{__('messages.ContactSend')}}</button>
                </div>
            </form>
        </div>
        <div class="Info">
			<div class="box">
				<div class="SMicon">
					<img src="img/locationIcon.png" alt="location Icon" style=" height: 65%">
				</div>
				<div class="text">
					<h3>{{__('messages.ContactAddre')}}</h3>
					<p>{{__('messages.ContactKSA')}}</p>
				</div>
			</div>
			<div class="box">
				<div class="SMicon">
					<img src="img/EmailIcon.png" alt="Email Icon" style="height: 45%">
				</div>
				<div class="text">
					<h3>{{__('messages.ContactEmail')}}</h3>
					<p>{{__('messages.ContactEAdd')}}</p>
				</div>
			</div>
			<div class="box">
				<div class="SMicon">
					<img src="img/PhoneIconp.png" alt="Phone Icon" style="height: 55%">
				</div>
				<div class="text">
					<h3>{{__('messages.ContactNo')}}</h3>
					<p>{{__('messages.ContactNum')}}</p>
				</div>
			</div>

		</div>
        </div>
    </div>
    <!-- about_area_end -->
@endsection
