    </div>
		<!-- /Main Wrapper -->
<!-- javascript links starts here -->
		<!-- jQuery -->
        <script src="{{asset('backend/assets/js/jquery-3.2.1.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('backend/assets/js/popper.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/bootstrap.min.js')}}"></script>

		<!-- Slimscroll JS -->
		<script src="{{asset('backend/assets/js/jquery.slimscroll.min.js')}}"></script>

		<!-- Chart JS -->
		<!-- <script src="{{asset('backend/assets/plugins/morris/morris.min.js')}}"></script> -->
		<script src="{{asset('backend/assets/plugins/raphael/raphael.min.js')}}"></script>
		<!-- <script src="{{asset('backend/assets/js/chart.js')}}"></script> -->

		<!-- Select2 JS -->
		<script src="{{asset('backend/assets/js/select2.min.js')}}"></script>



		<!-- Datetimepicker JS -->
		<script src="{{asset('backend/assets/js/moment.min.js')}}"></script>

        <?php if(@$theme_data->default_date_format == 'english'){?>
		<script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
        <?php } else if(@$theme_data->default_date_format == 'nepali'){?>
		<script src="{{asset('backend/assets/js/nepali.datepicker.v3.5.min.js')}}"></script>
		<?php } else{?>
		<script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
        <?php }?>


		<!-- Datatable JS -->
        <script src="{{asset("backend/assets/jquery.dataTables.min.js")}}" ></script>
{{--		<script src="{{asset('backend/assets/js/jquery.dataTables.min.js')}}"></script>--}}
		<script src="{{asset('backend/assets/js/dataTables.bootstrap4.min.js')}}"></script>


		<script src="{{asset('backend/assets/js/jspdf.min.js')}}"></script>
		<script src="{{asset('backend/assets/js/html2canvas.min.js')}}"></script>


		<!-- Form Validation JS -->
		<script src="{{asset('backend/assets/js/form-validation.js')}}"></script>

			<!-- Datetimepicker JS -->
		<script src="{{asset('backend/assets/js/moment.min.js')}}"></script>

		<!-- Custom JS -->
		<script src="{{asset('backend/assets/js/app.js')}}"></script>
		<!-- javascript links ends here  -->

		<script src="{{asset('backend/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

		<script>


			$(document).ready(function(){




			var notificationTimeout;
			var notificationPopup = $('.notification-popup ');
			//Shows updated notification popup
			// var updateNotification = function(task, notificationText, newClass){
			// 	var notificationPopup = $('.notification-popup ');
			// 	notificationPopup.find('.task').text(task);
			// 	notificationPopup.find('.notification-text').text(notificationText);
			// 	notificationPopup.removeClass('hide success');
				// If a custom class is provided for the popup, add It

				if(notificationTimeout)
					clearTimeout(notificationTimeout);
				// Init timeout for hiding popup after 3 seconds
					notificationTimeout = setTimeout(function(){
					notificationPopup.addClass('hide');
				}, 3000);
			// };
			});
		</script>
        @yield('js')


    </body>
</html>
