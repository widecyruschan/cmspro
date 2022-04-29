$(function() {
    "use strict";
    //like item
    $(document).on('click', '.blogLike', function() {
		var like =  $(this).data("vote");
        var url = $(this).data('url');
        var id = $(this).data('id');
        var $this = $(this);
		
        $(this).transition('scaleOut',{
            duration: 800,
            complete: function() {
                $this.replaceWith('<i class="icon check"></i>');
				$.post(url + 'blog/controller.php', {
					action: "like",
					id: id,
					type: like
				}, function(json) {
					if(json.status === "success") {
					  Cookies.set("BLOG_voted", id, {
						  expires: 120,
						  path: '/'
					  });
					}
				}, "json");
            }
        });
    });
});