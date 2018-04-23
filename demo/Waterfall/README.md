# Waterfall Layout Principle
Waterfall Layout Principle are as fallows:

1.In HTML,you should set up 3 DIV:The first one is #main,which is using wrap with all the .box . The second one is .box ,which is using wrap 
with all the .pic;The last one is .pic ,which is using wrap with the pictrue you wanna should.

2.Set CSS:In #main, you should set 'position:relative', beacuse all pictrues are setting postiong by Absolute Positioning.

3.Getting outerWidth() of the pictrue.

4.Getting cols.

5.Setting #main box width by mutiplying width and cols ,and set 'margin:0 auto';

7.Using $box.each() to loop .

8.Getting the height of first line pictrues,and putting into the Array.

9.Getting the minH,minHindex of Array.Then resetting Array and setting CSS

//...英语能力水平有限...

10.判断最后一个div距离页面顶部的距离加上半个div是否小于页面的高度加上滚动条的高度,如果是true，则循环json数据格式中的src属性，并动态的创建div
然后appendTo各个div中..最后再调用一次waterfall();
