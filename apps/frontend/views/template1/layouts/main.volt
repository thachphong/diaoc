<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1,maximum-scale=1">
	  <meta property="og:site_name" content="diaocviet.vn">
      <meta property="og:title" content="<%$web_title%>">
      <meta property="og:description" content="<%$web_des%>">  
     <!-- <meta property="og:image" content="/images/logo.png"> -->
      <title><%$web_title%></title>
      {{ stylesheet_link('template1/css/bootstrap.min.css') }}
      {{ stylesheet_link('template1/css/style.css?ver=1.1.1') }}
      {{ stylesheet_link('template1/css/icon-font-awesome.css') }}
      {{ javascript_include('template1/js/jquery.min.js') }}
      {{ javascript_include('template1/js/bootstrap.min.js') }}
        
   </head>
   <body>
      <div class="row">
         <div class="container" id="header">
            <div class="row" >
               <div class="col-md-4 col-sm-4 col-xs-6">
                  <img src="{{url.get('template1/images/logo.png')}}" />  
               </div>
               {% set login_info= elements.getuser()%}
               <div class="col-md-8 col-sm-8 col-xs-6">
                  <ul class="dang-tin-icon">
                     <li><span class="fa fa-pencil"></span><a href="{{url.get('dang-tin/0')}}">Đăng tin miễn phí</a></li>
                     {%if login_info is defined%}
                        <li><span class="fa fa-users"></span><a href="{{url.get('thanh-vien')}}">{{login_info.user_name}}</a></li>
                        <li><span class="fa fa-sign-out"></span><a href="{{url.get('users/logout')}}">Thoát</a></li>
                     {%else%}
                        <li><span class="fa fa-pencil-square-o"></span><a href="{{url.get('dang-ky')}}">Đăng ký</a></li>
                        <li><span class="fa fa-users"></span><a href="{{url.get('dang-nhap')}}">Đăng nhập</a></li>
                     {%endif%}
                     
                  </ul>
               </div>        
            </div> 
         </div>
      </div>  
      <div class="row background_menu">
         <div class="container" id="header">            
            <div class="menu_top">
               <ul class="dropDownMenu">
                  {{ elements.getMenu() }}
               </ul>
            </div>
         </div>
      </div>
       {{ content() }}
      {{ partial('includes/footer') }}
   </body>
</html>