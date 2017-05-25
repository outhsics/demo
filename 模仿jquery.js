;(function(){
	function $(selector){
		return  new Tq(selector);
	}

	//产生一个[n,m]之间的一个整数
	$.random = function(n,m){
		return Math.ceil(n + (m-n)*Math.random());
	}
	$.trim = function(yourstring){
		return yourstring.replace(/^\s+|\s+$/g,"");
	}
	$.reg = {
			isqqEmail : function(yourEmail){
				return /^\w{6,20}@qq\.com$/.test(yourEmail);
			},
			isPhone : function(yourPhone){
				return /^1[34578]\d{9}$/.test(yourPhone);
			}
	}

	function Tq(selector) {
		this.eles = [];
		//把你选中元素保存在自用属性中
		// 如果选择器第一个字符是“#”，可以直接调用 getElementById
		if(typeof selector =="string" && selector.charAt(0) =="#"){
			this.eles[0] = document.getElementById(selector.slice(1));
			//console.info(ele)
		}
		// else if(typeof selector =="string" && selector.charAt(0) =="."){
		else{
			var t = document.querySelectorAll(selector) ;
			for (var i = 0; i < t.length; i++) {
				this.eles.push(t[i]);
			}
		}
		
	}

	// Tq.prototype.hide = function(){
	// 	for(var i =0; i<this.eles.length;i++)
	// 		this.eles[i].style.display = "none";
	// }
	Tq.prototype.hide = function(){
		this.each(
			function(){
				console.info(this);
				this.style.display = "none";
			}
		)
	}
	Tq.prototype.each = function(func){
		for (var i = 0; i < this.eles.length; i++) {
			func.call(this.eles[i]);
		}
	}

	Tq.prototype.attr = function(arg1,arg2) {
		//console.info(this.ele,arg1,arg2);
		if(arguments.length == 1 && typeof arg1 == "object"){
			//设置多个属性
			// console.info(arg1);
			for(var p in arg1){
				// console.info("属性名:"+p,"属性值"+arg1[p]);
				this.ele.setAttribute(p,arg1[p]);
			}
		}
		else if(arguments.length == 1 && typeof arg1 =="string"){
			//获取arg1属性的值
			return this.ele.getAttribute(arg1);
		}
		else if(arguments.length == 2){
			//设置单个属性
			this.ele.setAttribute(arg1,arg2)
		}

		return this;
	}
	Tq.prototype.css = function(arg1,arg2){
		var needspx = ["width","height","margin-top","line-height","margin-left","padding"]
		if(arguments.length == 1 && typeof arg1 == "object"){
			//设置多个样式
			for (var p in arg1) {
				// console.info("样式名:"+p,"样式值"+arg1[p]);
				//设置单个样式
				if(needspx.indexOf(p) != -1 ){
					//现在是设置width,我要去检测用户是否设置了单位，如果没有设置，我就给它加一个px
					if(arg1[p].slice(-2) != "px"){
						arg1[p] +="px";
					}
				}
				for (var i = 0; i < this.eles.length; i++) {
					this.eles[i].style[p] = arg1[p];
				}
				// this.ele.style[p] = arg1[p];
			}
		}
		else if(arguments.length == 1 && typeof arg1 == "string"){
			if(this.eles.length == 1){
				//获取样式
				if(window.getComputedStyle)
					return  window.getComputedStyle(this.eles[0])[arg1] ;
				else{
					return this.eles[0].currentStyle[arg1] ;
				}
			}
			else if(this.eles.length > 1){
				var result = [];
				for (var i = 0; i < this.eles.length; i++) {
					//获取样式
					if(window.getComputedStyle)
						result.push(window.getComputedStyle(this.eles[0])[arg1]) ;
					else{
						result.push(this.eles[0].currentStyle[arg1]) ;
					}
				}
				return result;

			}
			
		}
		else if(arguments.length == 2){
			//设置单个样式
			if(needspx.indexOf(arg1) != -1 ){
				//现在是设置width,我要去检测用户是否设置了单位，如果没有设置，我就给它加一个px
				if(arg2.toString().slice(-2) != "px"){
					arg2 +="px";
				}
			}
			for (var i = 0; i < this.eles.length; i++) {
					this.eles[i].style[arg1] = arg2;
			}
			// this.ele.style[arg1] = arg2;
		}

		return this;
	}

	Tq.prototype.show = function(){
		for(var i =0; i<this.eles.length;i++)
			this.eles[i].style.display = "block";
	}

	

	Tq.prototype.addClass = function(yourClassName){
		//先判断是否有这个类
		// if(false == this.hasClass(yourClassName){
		if( !this.hasClass(yourClassName) ){

			//获取当前元素的class
			var classname =  this.attr("class") ;

			//添加
			var newClassName = classname +" " + yourClassName;
			//保存
			this.attr("class",newClassName);
		}
	}

	//把当前元素的类中，删除指定的类
	Tq.prototype.removeClass = function(yourClassName){
		//a b c ab abc
		//有没有 a
		//获取当前元素的class
		var classname =  this.attr("class") ;
		// /\baa\b/g
		var reg = new RegExp("\\b"+yourClassName+"\\b","g");
		
		console.dir(reg);

		var newClassName = classname.replace(reg,"");

		//把这个新的newClassName保存回去
		this.attr("class",newClassName);

	}

	//检查当前的元素的 clas中是否有一个名为yourClassname的 class
	//返回值是true | false
	Tq.prototype.hasClass= function(yourClassName){
		//获取当前元素的class
		var classname =  this.attr("class") ;

		var arr = classname.split(" ");

		return -1 != arr.indexOf(yourClassName);

		// return -1 != this.attr("class").split(" ").indexOf(yourClassName);


		// return -1 != arr.indexOf(yourClassName);

		// if(-1 == arr.indexOf(yourClassName) ){
		// 	return false;
		// }
		// else{
		// 	return true
		// }
	}



	window.$ = $;

})()
	