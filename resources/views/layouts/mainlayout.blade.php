<!DOCTYPE html>

<html lang="en">

 	<head>

   		@include('layouts.partials.head')
           @toastr_css

 	</head>


 	<body>

		@include('layouts.partials.nav')

            <div class="row">
                <div class="col-12">
                    @include('layouts.partials.flash')
                </div>
            </div>



		@yield('content')


		@include('layouts.partials.footer-scripts')

 	</body>

     @jquery
     @toastr_js
     @toastr_render
</html>
