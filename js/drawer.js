$(function() {
	
	var body = $('body');
	var wrapper = $('#wrapper');
	var drawer = $('#global');
	var drawerWidth = drawer.width();
	var openButton = $('#header .open');
	var closeButton = $('#global .close');
	
	//上に重ねるレイヤー
	body.append('<div id="disable-layer"></div>');
	var disableLayer = $('#disable-layer');
	
	//メニューを開くときの動作
	function openMenu(){
		drawer.addClass('active');
		drawer.css({
			'margin-left': -drawerWidth,
			'box-shadow': '-2px 0px 4px rgba(0,0,0,0.3)'
		});
		wrapper.css({
			'margin-left': -drawerWidth
		});
		disableLayer.css({
			display: 'block'
		});
	}
	
	//メニューを閉じるときの動作
	function closeMenu(){
		drawer.removeClass('active');
		drawer.css({
			'margin-left': 0,
			'box-shadow': ''
		});
		wrapper.css({
			'margin-left': 0
		});
		disableLayer.css({
			display: 'none'
		});
	}
	
	//メニューを開く
	openButton.click(function(){
		if( drawer.hasClass('active') ){
			closeMenu();
		}else{
			openMenu();
		}
	});
	
	//メニューを閉じる
	closeButton.click(function(){
		if( drawer.hasClass('active') ){
			closeMenu();
		}
	});
	
	//メニューを開いた状態のときにメニュー以外をクリックで閉じる
	disableLayer.click(function(){
		if( drawer.hasClass('active') ){
			closeMenu();
		}
	});
	
	//ヘッダー高さ分を調整
	var header = $('#header');
	var headerPadding = 10;
	var headerHeight = header.height();
	body.css('padding-top', headerHeight+headerPadding*2);
	
	//アコーディオン
	var trigger = $('#global-menu .trigger');
	trigger.click(function(){
		var target = $(this).next();
		$(this).toggleClass('active');
		target.toggleClass('active');
	});
	
});