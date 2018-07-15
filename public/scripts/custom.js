	$(function(){
      $('.feed_artcile').each(function(){
           var url = replaceHtmlLink($(this).html());
           $(this).html( url );
      });
    });
	
	$(function(){
      $('.stream-text.feed-comment').each(function(){
          console.log($(this));

            var url = replaceHtmlLink($(this).html());
            $(this).html( url );
      });
    });
    
    var replaceHtmlLink = function(html) {

        if (html.match(/(https|http|ftp):\/\/.+/)){
            // URL形式の場合
            html = html.replace(/(https|http|ftp)(:\/\/)([-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/gi, "<a href='$1$2$3' target='_blank'>$1$2$3</a>");
        }
        return html;
    }

