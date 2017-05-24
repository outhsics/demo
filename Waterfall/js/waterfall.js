$(window).on('load', function() {
    waterfall();
    var dataInt = {
        'data': [{
            'src': '21.jpg'
        }, {
            'src': '22.jpg'
        }, {
            'src': '23.jpg'
        }, {
            'src': '24.jpg'
        }, {
            'src': '0.jpg'
        }, {
            'src': '1.jpg'
        }]
    };
    $(window).on('scroll', function() {
        if (checkscroll()) { //判断是否符合预加载图片的条件...
            $.each(dataInt.data,function(index, el) {
                var $obox=$('<div class="box"></div>').appendTo('#main');
                var $opic=$('<div class="pic"></div>').appendTo($obox);
                $('<img>').attr('src',"images/"+$(el).attr('src')).appendTo($opic);
            });
            waterfall()
        }
    });
});

function waterfall() {
    var $box = $('#main>div');
    var $width = $box.eq(0).outerWidth();
    var $cols = Math.floor($(window).width() / $width);
    $('#main').css({
        'width': $width * $cols + 'px',
        'margin': '0 auto'
    })
    var harr = [];
    $box.each(function(index, el) {
        var $height = $box.eq(index).outerHeight();
        if (index < $cols) {
            harr[index] = $height;
        } else {
            var minH = Math.min.apply(null, harr);
            var minHindex = $.inArray(minH, harr);
            harr[minHindex] += $box.eq(index).outerHeight();
            $(el).css({
                'position': 'absolute',
                'left': minHindex * $width + 'px',
                'top': minH + 'px'
            })
        }
    });
}


function checkscroll() {
    var $lastbox = $('#main>div:last');
    var $lastheight = $lastbox.offset().top + Math.floor($lastbox.height() / 2);
    var $scroll = $(window).scrollTop();
    var $winheight = $(window).height();
    return ($lastheight < $scroll + $winheight) ? true : false;
}