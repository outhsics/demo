$(document).ready(function() {
	// 搜索框文字效果
	$("#inputSearch").focus(function() {
		$(this).addClass("focus")
		if ($(this).val() == this.defaultValue) { //this.defaultValue
			$(this).val("");
		}
	}).blur(function() {
		$(this).removeClass("focus")
		if ($(this).val() == '') {
			$(this).val(this.defaultValue);
		}
	}).keyup(function(event) {
		if (event.which == 13) {
			alert("回车提交表单！")
		}
	});

	// 网页换肤
	function switchSkin(skinName) {
		$("#" + skinName).addClass("selected").siblings().removeClass("selected");
		$("#cssfile").attr("href", "styles/skin/" + skinName + ".css");
		$.cookie("keith", skinName, {
			expires: 7,
			path: "/"
		})
	}
	$("#skin li").click(function() {
		switchSkin(this.id);
	})
	var $keith = $.cookie("keith");
	if ($keith) {
		switchSkin($keith);
	}

	// 导航效果
	$("#nav li").hover(function() {
			$(this).find(".jnNav").show(); //mouseenter,简化DOM中的mouseenter事件
		},
		function() {
			$(this).find(".jnNav").hide(); //mouseleave,简化DOM中的mouseleave事件
		})

	// 左侧商品分类热销效果
	$(".jnCatainfo .promoted").append('<i class="hot"></i>')


	// 右侧上部产品广告效果
	var index = 0;
	var len = $("#jnImageroll div a").length;
	var $keith = null;
	$("#jnImageroll div a").mouseover(function() {
		index = $("#jnImageroll div a").index($(this));
		showImg(index);
	}).eq(0).mouseover();


	$("#jnImageroll").hover(function() { //mouseenter
		if ($keith) {
			clearInterval($keith);
		}
	}, function() {
		$keith = setInterval(function() { //mouseleave
			showImg(index)
			index++;
			if (index == len) {
				index = 0
			}
		}, 3000)
	}).trigger('mouseleave');

	function showImg(index) {
		var $link = $("#jnImageroll div a");
		var $href = $link.eq(index).attr("href");
		$("#JS_imgWrap").attr("href", $href)
			.find("img").eq(index).stop(true, true).fadeIn().siblings().fadeOut();
		$link.removeClass('chos').css("opacity", 0.7)
			.eq(index).addClass('chos').css("opacity", 1)
	}
	// 右侧最新模块内容添加超链接提示
	var x = 15;
	var y = 20
	$("#jnNoticeInfo li a").mouseover(function(event) {
		this.myTitle = this.title
		var $page = '<div id="tooltip">' + this.myTitle + '</div>';
		$("body").append($page)
		this.title = '';
		$("#tooltip").css({
			"top": (event.pageY + y) + "px",
			"left": (event.pageX + x) + "px"
		}).show("fast")
	}).mouseout(function() {
		$("#tooltip").remove()
		this.title = this.myTitle
	}).mousemove(function(event) {
		$("#tooltip").css({
			"top": (event.pageY + y) + "px",
			"left": (event.pageX + x) + "px"
		})
	});
	// 右侧下部光标滑过产品列表效果
	$("#jnBrandTab li>a").click(function() {
		$(this).parent().addClass('chos').siblings().removeClass('chos')
		var $index = $("#jnBrandTab li a").index($(this))
		showPic($index);
		return false;
	}).eq(0).click();


	function showPic(index) {
		var $show = $("#jnBrandList");
		var len = 4;
		var speed = "slow";
		var $width = ($("#jnBrandList li").outerWidth()) * len;
		if (!$show.is(":animated")) {
			$show.animate({
				"left": -$width * index
			}, speed)
		}
	}

	$("#jnBrandList li").each(function(index) {
		var $img = $(this).find("img");
		var $width = $img.width();
		var $height = $img.height();
		var $page = "<span style='position:absolute;top:0;left:5px;width:" + $width + "px;height:" + $height + "px;' class='imageMask'></span>";
		$($page).appendTo($(this))
	});

	$("#jnBrandList").find(".imageMask").live('hover', function() {
		$(this).toggleClass("imageOver")
	});


});

$(document).ready(function() {
	// detail star
	// jquery.zoom star
	$('.jqzoom').jqzoom({
		zoomType: "standard",
		lens: true,
		preloadImages: false,
		alwaysOn: false,
		zoomWidth: 340,
		zoomHeight: 340,
		xOffset: 10,
		yOffset: 0,
		position: 'right'
	});
	//jquery.zoom end
	$(".imgList li a").click(function() {
		var $img = $(this).find("img").attr("src");
		var i = $img.lastIndexOf(".");
		var unit = $img.substring(i);
		$img = $img.substring(0, i);
		$("#thickImg").attr("href", $img + "_big" + unit);
	});
	$('.tab_menu li').click(function() {
		$(this).addClass("selected").siblings().removeClass("selected");
		var $index = $('.tab_menu li').index(this);
		$(".tab_box").find("div").eq($index).show().siblings().hide();
	}).hover(function() {
		$(this).addClass("hover")
	}, function() {
		$(this).removeClass('hover')
	});

	$(".color_change li img").click(function() {
		var $alt = $(this).attr("alt");
		$(".color_change strong").text($alt);
		var $src = $(this).attr("src");
		var i = $src.lastIndexOf(".");
		var unit = $src.substring(i);
		$src = $src.substring(0, i);
		$("#bigImg").attr("src", $src + '_one_small' + unit);
		$("#thickImg").attr("href", $src + '_one_big' + unit);
		var newsrc = $src.replace("images/pro_img/", "");
		$(".imgList li").hide();
		$(".imgList").find(".imgList_" + newsrc).show()
		$(".imgList").find('.imgList_' + newsrc).eq(0).find("a").click()
	})
	$(".pro_size ul li ").click(function() {
		var $text = $(this).text();
		$(".pro_size strong").text($text);
		$(this).addClass('cur').siblings().removeClass('cur')
	})

	var price = $(".pro_price strong").text();
	$("#num_sort").change(function() {
		var amount = $(this).val();
		var total = price * amount;
		$(".pro_price strong").text(total);
	}).change();

	$(".pro_rating ul li a").click(function() {
		var $classname = $(this).parent().attr("class");
		$(this).parent().parent().removeClass().addClass('rating ' + $classname + 'star');
		$(this).blur()
		return false;
	})
	var $right = $("#jnDetails");
	$(".cart a").click(function() {
			var $proname = $right.find("h4:first").text();
			var $procolor = $right.find('.color_change strong').text();
			var $prosize = $right.find(".pro_size strong").text();
			var $pronum = $right.find("#num_sort").val();
			var $proprice = $right.find(".pro_price strong").text();
			var dialog = '感谢您的购买\n您购买的\n' +
				'产品是：' + $proname + ";\n" +
				'尺寸是：' + $prosize + ";\n" +
				'颜色是：' + $procolor + ";\n" +
				'数量是：' + $pronum + ";\n" +
				'总价是：' + $proprice + "元";
			alert(dialog);
			return false;
		})
		// detail end
});