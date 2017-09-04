<div class="col-md-4 col-sm-12 col-xs-12 margin_top">
         <div class="row margin_top">
            <div class="pn_title">
               <span class="bg_icon" style="padding: 6px 4px 4px 2px;"><i class="fa fa-list"></i></span>
               <h3>Tin đặc biệt</h3>
            </div>
            <div class="viplist">               
               {{ elements.getTindacbiet() }}
            </div>
         </div>
         <div class="row margin_top">
            <div class="pn_title">
               <span class="bg_icon" style="padding: 6px 4px 4px 2px;"><i class="fa fa-list"></i></span>
               <h3>Tin xem nhiều</h3>
            </div>
            
            <div class="newsboxrow pn_background pn_border">
               <div class="colbox ">
                     <ul class="boxright">
                     {{ elements.getTinxemnhieu() }}
                     </ul>
               </div>
            </div>  
         </div>
         <div class="row margin_top">
            <div class="pn_title">
               <span class="bg_icon" style="padding: 6px 4px 4px 2px;"><i class="fa fa-list"></i></span>
               <h3>Dự án nổi bật</h3>
            </div>
            <div class="viplist">
            	{{ elements.getduannoibac() }}            
            </div>
         </div>
      </div>