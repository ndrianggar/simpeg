check_online();
check_notice_unread();

$('.rupiah').on('keyup',function(){
	var awal 	= numeral($(this).val()).value();
	$(this).val(numeral(awal).format());
});

$('.form-control').on('keyup',function(e){
	if (e.keyCode==222) {
		var amankan 	= $(this).val();
		$(this).val(amankan.replace("'","`"));
	}
});

$('.tanggal').datepicker({
	format : "dd-mm-yyyy",
	autoclose : true
});

var auto_refresh 	= setInterval(function (){
	check_notice_unread();
	check_online();
}, 10000);

function check_notice_unread(){
	var akses 		= $('#akses_pegawai').val();
	if (akses=="Admin") {
		var target 		= $('#logo_site').attr('href') + 'notice/data_admin_unread';
	} else {
		var target 		= $('#logo_site').attr('href') + 'notice/data_user_unread';
	}
	var asal 		= parseInt($('#total_notice').html());
	$.ajax({
		type: 		'ajax',
		method: 	'post',
		url: 		target,
		async: 		true,
		dataType: 	'json',
		success: 	function(response){
			if (asal!==parseInt(response['angka'])) {
				$('#total_notice').html(response['angka']);
				$('#menu_notice').html(response['list_notice']);
				if (parseInt(response['angka'])==0) {
					$('#total_notice').attr('Style','Display: none;');
				} else {
					$('#total_notice').attr('Style','Display: Block;');
				}
			}
		},
		error: function(){
			$('#total_notice').attr('Style','Display: none;');
		}
	});
};

function check_online(){
	var target 		= $('#logo_site').attr('href');
	var asal 		= parseInt($('#user_online').html());
	$.ajax({
		type: 		'ajax',
		method: 	'post',
		url: 		target + 'user/check_online',
		async: 		true,
		dataType: 	'json',
		success: 	function(response){
			if (asal!==parseInt(response['angka'])) {
				$('#user_online').html(response['angka']);
				$('#menu_user').html(response['list_user']);
				if (parseInt(response['angka'])==0) {
					$('#user_online').attr('Style','Display: none;');
				} else {
					$('#user_online').attr('Style','Display: Block;');
				}
			}
		},
		error: function(){
			$('#user_online').attr('Style','Display: none;');
		}
	});
};