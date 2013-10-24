// 注册表单
$('form[name="register"] input').blur(function() {
	var name = $(this).attr('name');
	var val = $(this).val();
	var tipObj = $(this).parent().nextAll('.tip');
	tipObj.removeClass('tip_success');
	tipObj.removeClass('tip_error');
	tipObj.html('<img src="/image/icon/loading.gif">');
	
	if (name == 'email') {
		if (val.length == 0) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 邮箱地址不能为空');
		}
		else
		if (val.length < 5 || val.length > 40) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 邮箱地址长度应为5-40位');
		}
		else
		if (!isEmail(val)) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 邮箱地址格式错误');
		} else {
			$.post(
				'/common/getByField',
				{action : 'user', name : 'email', value : val, retType : 'ajax'},
				function(res) {
					if (res != null) {
						tipObj.addClass('tip_error');
						tipObj.html('<i class="fa fa-times"></i> 邮箱地址已存在');
					}
					else {
						tipObj.addClass('tip_success');
						tipObj.html('<i class="fa fa-check"></i>');
					}
				}
			);
		}
	}
	
	if (name == 'password') {
		if (val.length == 0) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 密码不能为空');
		}
		else
		if (val.length < 6 || val.length > 20) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 密码长度应为6-20位');
		}
		else {
			tipObj.addClass('tip_success');
			tipObj.html('<i class="fa fa-check"></i>');
		}
	}
	
	if (name == 'name') {
		if (val.length == 0) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 姓名不能为空');
		}
		else
		if (val.length < 2 || val.length > 20) {
			tipObj.addClass('tip_error');
			tipObj.html('<i class="fa fa-times"></i> 姓名长度应为2-20位');
		}
		else {
			var flag = true;
			for (var i = 0; i < val.length; i++)
			if (!(/[\u4e00-\u9fa5]|[A-Z]|[a-z]|_|-|[0-9]+/).test(val[i]))
				flag = false;
			if (!flag) {
				tipObj.addClass('tip_error');
				tipObj.html('<i class="fa fa-times"></i> 仅支持中英文、数字、_或减号');
			} else {
				tipObj.addClass('tip_success');
				tipObj.html('<i class="fa fa-check"></i>');
			}
		}
	}
});




