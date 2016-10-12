define(['cjs'], function($) {
	
	var cjs = createjs || {};
	
	// load images
	var queue = ['p1/close.png','back.png','p2/beijing.jpg','p2/shanghai.jpg','p2/chengdu.jpg','p4/scene1.jpg','p4/scene2.jpg','p4/scene3.jpg','p4/scene4.jpg','p4/drink1.jpg','p4/drink2.jpg','p4/drink3.jpg','p4/drink4.jpg','p4/theme1.jpg','p4/theme2.jpg','p4/theme3.jpg','p4/theme4.jpg','final/city1.png','final/city2.png','final/city3.png','final/drink1.png','final/drink2.png','final/drink3.png','final/drink4.png','final/scene1.png','final/scene2.png','final/scene3.png','final/scene4.png','final/theme1.png','final/theme2.png','final/theme3.png','final/theme4.png','final/city4.png','p4/share_tip.png','p5/submit_msg.png'
	];
	
	var loader = new cjs.LoadQueue(false, 'assets/art/');
	// loader.on('fileload', handleFileload);
	// loader.on('complete', handleComplete);
	loader.loadManifest(queue);
});