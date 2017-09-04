{{ stylesheet_link('froala/css/froala_style.css')}}
<div class="row">
   <div class="container">
   
      <div class="col-md-8 col-sm-12 col-xs-12 margin_top">
         <div class="row margin_top pn_background pn_border post_pn" >
            <div class="post_head">
               <h1>{{news_name}}</h1>
               <div class="khuvuc" style="font-style: italic;color:#575353">
                  {{add_date}}
               </div>
            </div>
            <hr class="line" />
            <div class="fr-element fr-view">
                     {{content}}
            </div>
         </div>
         <div class="row margin_top" >
            <div class="pn_title">
               <span class="bg_icon" style="padding: 6px 4px 4px 2px;"><i class="fa fa-list"></i></span>
               <h1>Bài viết liên quan</h1>               
            </div>
            {%for key,item in relations%}
            <div class="col-md-6 col-sm-6 col-xs-12 {%if key%2==0 %}col_left{%else%}col_right{%endif%}" >
               <div class="relation_item pn_background pn_border">
                  <a href="{{url.get('t/')}}{{item['news_no']}}_{{item['news_id']}}"><img  src="{{url.get('crop/120x79/')}}{{item['img_path']}}"></a>
                  <a class="linkpost" href="{{url.get('t/')}}{{item['news_no']}}_{{item['news_id']}}">{{item['news_name']}}</a>
               </div>
            </div>
            {%endfor%}
         </div>
         <div class="row margin_top" >
            <div class="pn_title">
               <span class="bg_icon" style="padding: 6px 4px 4px 2px;"><i class="fa fa-list"></i></span>
               <h1>Bình luận</h1>               
            </div>
            <div class="row margin_top pn_background pn_border">
               <ul class="nav nav-tabs" id="comment_tab">
                 <li class="active"><a data-toggle="tab" href="#tab1">Facebook</a></li>
                 <li><a data-toggle="tab" href="#tab2" >Google+</a></li>                 
               </ul>
               <div class="tab-content">
                  <div id="tab1" class="tab-pane fade in active">
                  <div class="fb-comments" data-href="{{url.get('t/')}}{{news_no}}_{{news_id}}" data-width="100%" data-numposts="20"></div>
                                 <div id="fb-root"></div>
                                    <script>(function(d, s, id) {
                                      var js, fjs = d.getElementsByTagName(s)[0];
                                      if (d.getElementById(id)) return;
                                      js = d.createElement(s); js.id = id;
                                      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=807407399380069";
                                      fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                  </div>
                  <div id="tab2" class="tab-pane fade">
                     <div id="google_comments" style="width:100%"></div>
                     <script src="https://apis.google.com/js/plusone.js" type="text/javascript" >{lang: 'vi'}</script>
                     <script>gapi.comments.render('google_comments',{
                        href:window.location.href,
                        width:"725",
                        first_party_property: 'BLOGGER',
                        view_type: 'FILTERED_POSTMOD'}
                        );
                        function fix_google()
                        {                           
                           $("#google_comments").css({"width":"100%"});                           
                           $("#google_comments iframe").css("width","100%");
                        }
                        setTimeout(fix_google,4000);
                     </script>
                  </div>
                  
               </div>
            </div>
            
         </div>

      </div>
      {{ partial('includes/right') }}
   </div>
</div>
