jQuery('#search_btn').on('click',function(){

        var city_name = jQuery('#city_name').val().trim();
        var radius = jQuery('#radius').val().trim();
        var tweets_num = jQuery('#tweets_num').val().trim();

        if(city_name != ''){
            jQuery('.input-group').removeClass('has-error');
                jQuery('#results').html('');
                jQuery('#results').css('background','url('+base_url+'images/loading.gif) 50% 50% no-repeat');
                jQuery('#results').css('background-size','200px 200px');
            
                jQuery.post(base_url+"Ajax/get_map" ,{address:city_name,tweets_num:tweets_num,radius:radius}, function(data){
                if(data.status == 'ok'){
                  if(data.tweets.length != 0){
                    jQuery('#city_name').val(data.formatted_address);
                    jQuery('#oper').html('');
                      create_map(data.tweets);
                }else{
                  jQuery('#oper').hide().html('<small class="text-warning"><b>No Tweets in this location</b></small>').show(1000);
                  jQuery('#results').css('background','none');
                }
                    }
                },"json");      
        }else{
          jQuery('.input-group').addClass('has-error');
        }   
        }); 

        function create_map(tweets){

            var locations = new Array();
            for ( var x=0;x<tweets.length;x++){
                var lat = tweets[x]['geo']['coordinates'][0];
                var lng = tweets[x]['geo']['coordinates'][1];
                 locations[x] = [x, lat , lng , x];
        }

        // get avg lat and long
    var latsum  = 0;
    var longsum = 0;
    var numMarkers = 0;
    for ( var i = 0; i < locations.length; i++ ) {
      if ( locations[i][1] && locations[i][2] ) {
      latsum += parseFloat( locations[i][1] );
      longsum += parseFloat( locations[i][2] );
      numMarkers++;
      }
    }
    var latavg = latsum / numMarkers;
    var longavg = longsum / numMarkers;

    var latlng = new google.maps.LatLng(latavg, longavg);
        
    var map = new google.maps.Map(document.getElementById('results'), {
      zoom: 11,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: tweets[i]['profile']
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {

            var tweet_text = tweets[i]['tweet'];
             var list = tweet_text.match( /\b(https:\/\/|www\.|https:\/\/www\.|http:\/\/|http:\/\/www\.)[^ <]{2,200}\b/g );
            if (list) {
                for ( y = 0; y < list.length; y++ ) {
                    var prot = list[y].indexOf('http://') === 0 || list[y].indexOf('https://') === 0 ? '' : 'http://';
                    tweet_text = tweet_text.replace( list[y], "<a target='_blank' href='" + prot + list[y] + "'>"+ list[y] + "</a>" );
                }

            }
            var username_link = "<a target='_blank' href='https://twitter.com/" + tweets[i]['tag'] + "'>"+ tweets[i]['username'] + "</a>"
            var html_display = '<b style="color:#269abc">'+username_link+'</b> @'+tweets[i]['tag']+'<br>'+tweet_text+'<br>'+tweets[i]['created'];
          infowindow.setContent(html_display);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}