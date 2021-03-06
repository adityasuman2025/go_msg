<div class="upload_what">
	<?php
		echo $upload_what = $_POST['upload_what'];
	?>
</div>

<input type="file" name="file" id="file" accept="video/*">
<br>
<div class="upload_pic_feed"></div>

<ul class="upload_ins">
	<li>Image size must be less than 1 MB.</li>
	<li>Video size must be less than 20 MB.</li>
</ul>

<button class="upload_done">Done</button>


<!--------script------>
	<script type="text/javascript">
	/*----for uploading pic----*/
		upload_what = $.trim($('.upload_what').text());

		$(document).on('change', '#file', function()
		{
			var property = document.getElementById("file").files[0];
			var image_name = property.name;
			var image_extension = image_name.split('.').pop().toLowerCase();
			var image_size = property.size;

			if(jQuery.inArray(image_extension, ['mp4', 'wmv', '3gp', 'webm']) == -1)
			{
				alert("Choose a valid video file");
			}
			else
			{
				if(image_size > 50000000)
				{
					alert('Video File Size is more than 45 MB');
				}
				else
				{
					var form_data = new FormData();
					form_data.append("file", property);

					$.ajax({
						url: "php/upload_" + upload_what + ".php",
						method: "POST",
						data: form_data,
						contentType: false,
						cache: false,
						processData: false,
						beforeSend:function()
						{
							$('.upload_pic_feed').text('Uploading...');
						},
						success: function(data)
						{
							$('.upload_pic_feed').html(data);
							$('.post_thumbnail').fadeIn(0).html(data);
							$('#file').fadeOut(0);
							$('.post_video').fadeOut(0);
							$('.post_photo').fadeOut(0);
							$('.upload_ins').fadeOut(0);
							
							$('.upload_done').fadeIn(0);

						//creating thumbnail in right side of textarea
							$('.post_textarea').removeClass('col-md-12');
							$('.post_textarea').addClass('col-md-9');
							$('.post_textarea').removeClass('col-xs-12');
							$('.post_textarea').addClass('col-xs-9');

						}
					});

				}

			}
			
		});

	/*-on clicking upload done------*/
		$('.upload_done').click(function()
		{
			$('.ajax_loading_bckgrnd').fadeOut(500);
			$('.ajax_loading_div').fadeOut(500);
		});
	</script>