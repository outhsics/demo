<?php
return array(
	//'������'=>'����ֵ'
		'DEFAULT_CONTROLLER'  => 'Login',       //��̨Ĭ�Ϸ��ʵĿ�����
	//Ȩ����֤
		'AUTH_CONFIG' => array(
		'AUTH_ON' => true, //��֤����
		'AUTH_TYPE' => 1, // ��֤��ʽ��1Ϊʱʱ��֤��2Ϊ��¼��֤��
		'AUTH_GROUP' => 'es_admin_group', //�û������ݱ���
		'AUTH_GROUP_ACCESS' => 'es_admin_group_access', //�û�����ϸ��
		'AUTH_RULE' => 'es_admin_rule', //Ȩ�޹����
		'AUTH_USER' => 'es_admin_user'  //�û���Ϣ��
		),
	//��ҳ����
		'VAR_PAGE' => 'page',
		'DEFAULT_NUMS' => '10',

);