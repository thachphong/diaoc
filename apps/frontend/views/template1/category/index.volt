<div class="row">
   {% set banners= elements.get_banner()%}
   {{ partial('includes/banner_left') }}
   <div class="container" id="content">            
      <div class="col-md-8 col-sm-12 col-xs-12 margin_top no_padding_left">
         <div class="row margin_top" >
            <div class="pn_title">
               <span class="bg_icon" style="padding: 6px 4px 4px 2px;"><i class="fa fa-list"></i></span>
               <h1>{{ctg_name}}</h1>
               <label class="read_more" style="font-weight:normal">có <strong>{{total_post}}</strong> tin bất động sản</label>
            </div>
            <div class="new_list">
               {%for item in post%}
                  <div class="row margin_top pn_background pn_border">
                     <div class="col-md-3 col-sm-3 col-xs-3 post_img">
                        <a href="{{url.get('b/')}}{{item['post_no']}}_{{item['post_id']}}">
                        <img src="{%if item['img_path']|length ==0%}{{url.get('crop/176x118/template1/images/post0.png')}}{%else%}{{url.get('crop/176x118/')}}{{item['img_path']}}{%endif%}" class="img_newlist"></a>
                     </div>
                     <div class="col-md-9 col-sm-9 col-xs-9">
                        <a href="{{url.get('b/')}}{{item['post_no']}}_{{item['post_id']}}" class="post_title">{{item['post_name']}}</a>
                        <div class="icon_post"><label><i class="fa fa-usd"></i>Giá<span>: </span></label><strong>{{item['price']}} {{item['m_unit_name']}}</strong></div>
                        <div class="icon_post"><label><i class="fa fa-university"></i>Diện tích<span>: </span></label>{{item['acreage']}} m2</div>
                        <div class="icon_post"><label><i class="fa fa-map-marker"></i>Vị trí<span>: </span></label>
                        {{item['m_district_name']}} - {{item['m_provin_name']}}</div>
                        <span class="post_date">{{item['start_date']}}</span>
                     </div>
                  </div>
               {%endfor%}
            </div>           
         </div> 
         {%if total_page > 1%}
         <div class="row margin_top" >
            <div class="col-md-12 col-sm-12 col-xs-12" style="display: flex;justify-content: center;">
               <ul class="page_number">
                  {%if page > 1%}
                     <li><a href="{{url.get('c/')}}{{ctg_no}}?page=1">Trang đầu</a></li>
                     <li><a href="{{url.get('c/')}}{{ctg_no}}?page={{(page-1)}}">Trang trước</a></li>
                  {%endif%}                 
                  
                  {%for i in  start..end%} 
                    <li {%if page == i%}class="active"{%endif%}><a href="{{url.get('c/')}}{{ctg_no}}?page={{i}}">{{i}}</a></li>
                  {%endfor%}
                  {%if page < total_page%}
                     <li><a href="{{url.get('c/')}}{{ctg_no}}?page={{page+1}}">Trang sau</a></li>
                     <li><a href="{{url.get('c/')}}{{ctg_no}}?page={{total_page}}">Trang cuối</a></li>
                  {%endif%}       
               </ul>
            </div>
         </div>
         {%endif%}
            
      </div>
      {{ partial('includes/right2') }}
   </div>
   {{ partial('includes/banner_right_2') }}
</div>