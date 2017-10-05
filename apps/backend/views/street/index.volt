<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Quản lý đường phố <!--<small>Some examples to get you started</small>--></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>                                 
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">              
			  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Danh sách đường phố<!--<small>Users</small>--></h2>                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class="btn btn-primary btn-sm" id="btn_new">Thêm mới</button></li>
                                          
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form method="GET" action="{{url.get('product')}}">
                    <div class="row form-group">
                    	<label class="col-sm-2">Tỉnh/Thành Phố</label>
                    	<div class="col-sm-2">
                    		<select class="form-control" name="m_provin_id" id="m_provin_id">
                    			<option value=""></option>
								{%for item in provincials%}
									<option value="{{item.m_provin_id}}" {%if m_provin_id == item.m_provin_id%}selected{%endif%}>{{item.m_provin_name}}</option>
								{%endfor%}
                    		</select>                		
                    	</div>                    	
                    	<label class="col-sm-1">Quận/Huyện</label>
                    	<div class="col-sm-3">
                    		<select id="m_district_id" class="form-control" name="m_district_id">
								<option value=""></option>
							</select>
                    	</div> 
                    	<div class="col-sm-1">
							<input class="btn btn-info" id="btn_find" type="submit" value="Tìm">
						</div>                   	                   	
                    </div>					
					</form>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         <!-- <th>STT</th>-->
                          <th>Tỉnh/Thành Phố</th>
                          <th>Quận Huyện</th>
                          <th>Tên đường phố</th>
                          <th>Sửa</th>
                          <th>Xóa</th>                         
                        </tr>
                      </thead>
                      <tbody>
                      {%if list != null %}
                      {% for item in list %}
                      	<tr>                          
                          <td>{{item['m_provin_name']}}</td>
                          <td>{{item['m_district_name']}}</td>
                          <td id="name_{{item['m_street_id']}}">{{item['m_street_name']}}</td>
                          <td>
                          	<button class="btn btn-warning btn-xs btn_edit" id="edit_{{item['m_street_id']}}">Sửa</button>
                          </td>                         
                          <td>
                          	<button class="btn btn btn-danger btn-xs btn_delete" id="del_{{item['m_street_id']}}">Xóa</button>
                          </td>                    
                        </tr>
                      {% endfor %}  
                      {%endif%}                      
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            	
            </div>
          </div>
        
</div>
<script>    
    
    $(document).ready(function() {
    	var district_list = Array();
    	{%for item in districts%}
			district_list.push(['{{item.m_district_id}}',"{{item.m_district_name}}",'{{item.m_provin_id}}']);
		{%endfor%}
		$(document).off('change','#m_provin_id');
		$(document).on('change','#m_provin_id',function(){			
			change_district_option('');			
		});
		var change_district_option= function(district_id){
			var val = $('#m_provin_id').val();
			var option = '<option value=""></option>';
			$.each(district_list,function(key,item){
				//console.log(item);
				if(val == item[2]){
					if(district_id == item[0] ){
						option +='<option value="'+item[0]+'" selected >'+item[1]+'</option>';
					}else{
						option +='<option value="'+item[0]+'" >'+item[1]+'</option>';
					}					
				}
			});
			$('#m_district_id').empty();
			$('#m_district_id').append(option);
		};
		$(document).off('click','#btn_new'); 
        $(document).on('click','#btn_new',function(event){
        	Pho_html_ajax('POST',"{{url.get('street/new')}}" ,{'silde_id':''},function(html){
                /*Pho_modal({
		        		template:html,
				        closeClick: false,
				        closable: true, 
				        modalid:"modal1",
				        size:'large'
		        	
            });*/
            	Pho_modal(html,"Thêm mới đường phố",700);
            });
        	
        });
        $(document).off('click','.btn_delete'); 
        $(document).on('click','.btn_delete',function(event){
        	var id = $(this).attr('id');
	        	id = id.replace("del_","");
	        var menu_name = $('#name_'+id).text();
        	Pho_message_confirm("Thông báo",'Bạn có chắc chắn muốn xóa đường phố "'+menu_name+'" ?',function(){
        		
				Pho_json_ajax('GET',"{{url.get('street/delete/')}}" + id,null ,function(datas){
					if(datas.status == "OK"){
						Pho_direct("{{url.get('street')}}");
					}else{
						Pho_message_box_error("Lỗi",datas.msg);
					}	                
	            });
        	});
        	
        });
        $(document).off('click','.btn_edit'); 
        $(document).on('click','.btn_edit',function(event){
        	var id = $(this).attr('id');
	        	id = id.replace("edit_","");			
            	Pho_html_ajax('GET',"{{url.get('street/edit/')}}"+ id ,null,function(html){  
            	Pho_modal(html,"Sửa đường phố",700);
            });
        });
        $(document).off('click','.dialog_close'); 
        $(document).on('click','.dialog_close',function(event){        	
			Pho_modal_close("modal1");
			Pho_direct(location.href);
        });
    });
</script>