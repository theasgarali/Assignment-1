
$('.star-rating').each(function(){
    var $this = $(this);
    var rating = $this.data('rate');

    for(i=0; i <= rating; i++){
        $this.find('span:nth-child(' + i + ')').addClass('checked');
    }
});