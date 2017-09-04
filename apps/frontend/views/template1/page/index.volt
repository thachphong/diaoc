{{ stylesheet_link('froala/css/froala_style.css')}}
<div class="row">
   <div class="container">
   
      <div class="col-md-8 col-sm-12 col-xs-12">
         <div class="pn_posts">
            <div class="pn_title">
               <span class="bg_icon"><i class="fa post-pencil"></i></span>
               <h1>{{page.page_name}} </h1>
            </div>            
            <div class="pn_content pn_background pn_border margin_top">               
               <div class="row">
                  <div class="fr-element fr-view">
                     {{page.content}}
                  </div>
               </div>
               
            </div>
         </div>
      </div>
      {{ partial('includes/right') }}
   </div>
</div>
