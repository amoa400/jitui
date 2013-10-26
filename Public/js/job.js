// 标签选择
$('.head .select span').click(function() {
	var name = $(this).attr('md_name');
	if (name == null) name = $(this).parent().attr('md_name');
	var value = $(this).attr('md_value');
	$('.head input[name="' + name + '"]').val(value);
	if (name == 'province_id')
		$('.head input[name="city_id"]').val(0);
	if (name == 'city_id')
		$('.head input[name="province_id"]').val(0);
	$('.head form').submit();
});
$('.pagination li').click(function() {
	var name = $(this).attr('md_name');
	if (name == null) return;
	var value = $(this).attr('md_value');
	$('.head input[name="page"]').val(value);
	$('.head form').submit();
});