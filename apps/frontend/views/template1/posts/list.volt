<div class="row">
	<div class="container">
		{{ partial('includes/user_left') }}
		<div class="col-md-9 col-sm-12 col-xs-12 margin_top">
			<div class="pn_title margin_top">
					<span class="bg_icon"><i class="fa post-pencil"></i></span>
					<h1>Quản lý tin đã đăng </h1>
			</div>
			<div class="row margin_top pn_background pn_border post_pn" >
            <div class="post_head">
               <div class="row">
						<table class="table table-bordered" style="font-size: 12px;">
							<tr>								
								<th>Mã tin</th>
								<th>Tiêu đề</th>
								<th>Trạng thái</th>
								<th>Ngày đăng</th>
								<th>Ngày hết hạn</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
							{%for item in list%}
							<tr>
								<td>{{item['post_id']}}</td>
								<td>{{item['post_name']}}</td>
								<td>{{item['status']}}</td>
								<td>{{item['start_date']}}</td>
								<td>{{item['end_date']}}</td>
								<td><a href="{{url.get('dang-tin/')}}{{item['post_id']}}" class="btn_blue">Sửa</a></td>
								<td><a href="{{url.get('posts/delete/')}}{{item['post_id']}}" class="btn_red_small">Xóa</a></td>
							</tr>
							{%endfor%}							
						</table>
					</div>
            </div>
            <!--<hr class="line" />-->
            
         </div>			
		</div>
	</div>
</div>
