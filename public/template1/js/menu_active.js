$(document).ready(function() {
	$('#header .dropDownMenu > li > a').removeClass('active');
	var li_list = $('#header .dropDownMenu > li');
	var url = window.location.href;
	var li_level1 = null;
	var find_flg = false;
	//console.log(trim(url,'/'));
	li_list.each(function(key,el){
		href = $(el).find('a').attr('href');
		li_level1 = el;		
		//console.log(href);
		if(href == url.substring(0,href.length) ){
			if(trim(href,'/') == window.location.origin){
				if(trim(href,'/') == trim(url,'/')){
					return false;
				}
			}else{
				return false;
			}			
		}else{
			var ul = $(el).find('ul');			
			var il_2 =ul.find('li');
			//console.log(il_2);
			il_2.each(function(key2,el2){
				href = $(el2).find('a').attr('href');
				//console.log('2:'+href);
				if(href == url.substring(0,href.length) ){
					if(trim(href,'/') == window.location.origin){
						if(trim(href.trim,'/') == trim(url,'/')){
							find_flg = true;
							return false;
						}
					}else{
						find_flg = true;
						return false;
					}
				}
			});
			if(find_flg){
				return  false;
			}
		}
	});
	return $(li_level1).find('a').addClass('active');	
});
function trim(s, mask) {
    while (~mask.indexOf(s[0])) {
        s = s.slice(1);
    }
    while (~mask.indexOf(s[s.length - 1])) {
        s = s.slice(0, -1);
    }
    return s;
}