<?php
	/*
	*	函数
	*
	*/

	//生成随机字符串 1:数字，0:字母，2:混合
	function verifRand($what,$number)
	{ 
			$string=''; 
			for($i = 1; $i <= $number; $i++)
			{ 
				//混合 
				$panduan=1; 
				if($what == 3){ 
					if(rand(1,2)==1){ 
						$what=1; 
					}else{ 
						$what=2; 
					} 
					$panduan=2; 
				}
				//数字 
				if($what==1){ 
					$string.=rand(0,9); 
				}elseif($what==2){ 
					//字母 
					$rand=rand(0,24); 
					$b='a'; 
					for($a =0;$a <=$rand;$a++){ 
						$b++; 
					} 
					$string.=$b; 
				} 
				if($panduan==2)$what=3; 
			} 
			return $string; 
	} 
	//echo myRand(1,5);

	//防止SQL注入 "_","%","\r\n","nbsp;","html"

	function post_check($post)     
	{     
		if (!get_magic_quotes_gpc()) // 判断magic_quotes_gpc是否为打开     
		{     
			$post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤     
		}     
		$post = str_replace("_", "\_", $post); // 把 '_'过滤掉     
		$post = str_replace("%", "\%", $post); // 把' % '过滤掉     
		$post = nl2br($post); // 回车转换     
		$post = htmlspecialchars($post); // html标记转换 
		$post = trim($post);//  去除空格
		return $post;     
	}    

	//检测电话号码是否合法
	function  tel_check($tel)
	{
		if (empty($tel)) {
			//echo "电话号码不能为空";
			return FALSE;
		}
		if(preg_match("/1[3458]{1}\d{9}$/",$tel)){  
			//echo "是手机号码";
			return TRUE;
		}else{    
			//echo "不是手机号码"; 
			return FALSE;
		}  
	}

	//打印函数、
	function p($a=array())
	{
		foreach ($a as $k) {
			echo "{";
			foreach ($k as $ke=> $v) 
			{
				print_r($ke);
				echo "=>";
				print_r($v);
				echo "<br>";
			}		
			echo "}";echo "<br>";
		}

	}