/**
 * author: VVG
 * My blog: http://www.cnblogs.com/NNUF/
 */
var Tool = {
    $:function (arg, context) {
        var tagAll, n, eles = [], i, sub = arg.substring(1);
        context = context || document;
        if (typeof arg == 'string') {
            switch (arg.charAt(0)) {
                case '#':
                    return document.getElementById(sub);
                    break;
                case '.':
                    if (context.getElementsByClassName) return context.getElementsByClassName(sub);
                    tagAll = $('*', context);
                    n = tagAll.length;
                    for (i = 0; i < n; i++) {
                        if (tagAll[i].className.indexOf(sub) > -1) eles.push(tagAll[i]);
                    }
                    return eles;
                    break;
                default:
                    return context.getElementsByTagName(arg);
                    break;
            }
        }
    },
    /* 添加样式名 */
    addClass:function (c, node) {
        if (!node)return;
        node.className = this.hasClass(c, node) ? node.className : node.className + ' ' + c;
    },

    /* 移除样式名 */
    removeClass:function (c, node) {
        var reg = new RegExp("(^|\\s+)" + c + "(\\s+|$)", "g");
        if (!this.hasClass(c, node))return;
        node.className = reg.test(node.className) ? node.className.replace(reg, '') : node.className;
    },

    /* 是否含有CLASS */
    hasClass:function (c, node) {
        if (!node || !node.className)return false;
        return node.className.indexOf(c) > -1;
    }
}

var AdMacker = function(){
    var image,width,height,iLeft,iTop,bgRGBA,bgOpacity,bgHeight,clickfile,
        titleFontSize,titleFontColor,titleLeft,titleTop,title,titleFontFamily,titleFontStyle,titleShow,
        desFontSize,desFontColor,desLeft,desTop,description,desFontFamily,desFontStyle,desShow;
    var bgRGB = '255,255,255';
    var imgScale = 1;

    var regex = {
        reg1:/^([1-9]\d*)$/,      // 验证正整数
        reg2:/^-?(0|[1-9]\d*)$/, // 验证零正负整数
        reg3:/^(0|0\.\d*|1)$/,   // 验证透明度0-1
        reg4:/^([1-9]|10|0\.\d*)$/,      // 缩放比例0-10，不包含0
        reg5:/^#([0-9a-zA-Z]{3}|[0-9a-zA-Z]{6})$/   // 验证颜色值
    }
    var tips = ['宽高只能为大于0的整数','偏移量只能为零和正负整数',
        '透明度值在0-1之间，包括0和1','比例限制在0-10之间，不包含0',
        '字号只能为正整数','颜色值格式不正确，为#fff或#ffffff格式'];

    // 读取文件数据
    var FileData = new FileReader();
    // 文件加载事件
    FileData.onload = function(event){
        image = new Image();
        // 文件加载事件
        image.onload = function(){
            drawImg(image,iLeft,iTop,image.width*imgScale,image.height*imgScale);
        }
        // event.target.result 获取文件路径
        image.src =  event.target.result;
    }


    // 创建画布
    function createCanvas(flag) {
    	clickfile=flag;
        var adMaker, canvas;
        if (!checkValue()) {
            return;
        }
        if (adMaker = Tool.$('#adMaker')) {
            adMaker.width = width;
            adMaker.height = height;
        } else {
            canvas = document.createElement('canvas');
            canvas.id = 'adMaker';
            canvas.width = width;
            canvas.height = height;
            Tool.$('#paper').innerHTML = '';
            Tool.$('#paper').appendChild(canvas);
        }
      //获取文件
        getfile();
    }

    function getfile() {
        var file = Tool.$('#file');
        // 验证上传文件格式
        var fileFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
        if (file.files.length === 0) {
            alert('请选择图片!');
            return;
        } else {
            var oFile = file.files[0];
            if (!fileFilter.test(oFile.type)) {
                alert("上传的文件必须是图片格式!");
                return;
            }
            // 传递数据到FileData，数据加载后引发FileData.onload事件
            FileData.readAsDataURL(oFile);
        }
    }

    function drawImg(img,left,top,imgwidth,imgheight){
        var canvas = Tool.$('#adMaker');
        var context = canvas.getContext('2d');
        if(clickfile){
        	Tool.$('#adWidth').value=imgwidth;
        	Tool.$('#adHeight').value=imgheight;
        	canvas.width=imgwidth;
        	canvas.height=imgheight;
        	
        }
        context.clearRect(0,0,width,height);
        context.drawImage(img,left,top,imgwidth,imgheight);
        
        // 绘制背景
        context.fillStyle = bgRGBA;
        context.fillRect(0,height - bgHeight, width, bgHeight);
        
        // 绘制标题文字
        if(titleShow==2){
        	context.translate(100, 100);
            context.rotate(90 * Math.PI / 180);
        }
        context.fillStyle = titleFontColor;
        context.font = titleFontStyle+"  bold "+ titleFontSize + "px "+titleFontFamily;
        context.fillText(title,titleLeft,titleTop);
       
        
        // 绘制描述文字
        
        if(desShow==2){
        	context.translate(100, 100);
            context.rotate(90 * Math.PI / 180);
        }
        context.fillStyle = desFontColor;
        context.font = desFontStyle+" normal " + desFontSize + "px "+desFontFamily;
        context.fillText(description,desLeft,desTop);
        
        

    }
    function putOut(){
        var canvas = Tool.$("#adMaker");
        if (canvas.getContext) {
            var ctx = canvas.getContext("2d");                // 获取2d画布
            var myImage = canvas.toDataURL("image/png");      // 转化为图像数据
        }
        var imageElement = Tool.$("#MyPix");  // 获取一个图像NODE
        imageElement.src = myImage;
        var aElement=Tool.$('#banner');
        aElement.href=myImage;
        showImage();
    }

    function showImage(){
        var mb = Tool.$('#mb');
        var img = Tool.$("#MyPix");
        mb.style.height=$(document.body).height();
        //mb.style.height=getScrollTop() ;
        mb.style.display = 'block';
        img.style.display = 'block';
        mb.onclick = function(){
            mb.style.display = 'none';
            img.style.display = 'none';
        }
    }
    
  
    function checkValue(){
        // 获取所有
        width = Tool.$('#adWidth').value;
        height = Tool.$('#adHeight').value;
        imgScale = Tool.$('#imgScale').value;
        iLeft = Tool.$('#iLeft').value;
        iTop = Tool.$('#iTop').value;
        bgOpacity = Tool.$('#bgOpacity').value;
        bgRGBA = 'rgba(' + bgRGB + ',' + bgOpacity + ')';
        bgHeight = Tool.$('#bgHeight').value;

        titleFontSize = Tool.$('#titleFontSize').value;
        titleFontColor = Tool.$('#titleFontColor').value;
        titleLeft = Tool.$('#titleLeft').value;
        titleTop = Tool.$('#titleTop').value;
        titleFontFamily = Tool.$('#titleFontFamily').value;
        titleFontStyle = Tool.$('#titleFontStyle').value;
        titleShow = Tool.$('#titleShow').value;
        title = Tool.$('#title').value;

        desFontSize = Tool.$('#desFontSize').value;
        desFontColor = Tool.$('#desFontColor').value;
        desTop = Tool.$('#desTop').value;
        desLeft = Tool.$('#desLeft').value;
        desFontFamily = Tool.$('#desFontFamily').value;
        desFontStyle = Tool.$('#desFontStyle').value;
        desShow = Tool.$('#desShow').value;
        description = Tool.$('#description').value;

        // 画布
        if(!checkFormat('adWidth',regex.reg1,tips[0],670))return false;
        if(!checkFormat('adHeight',regex.reg1,tips[0],240))return false;

        // 图片
        if(!checkFormat('imgScale',regex.reg4,tips[3],1))return false;
        if(!checkFormat('iLeft',regex.reg2,tips[1],0))return false;
        if(!checkFormat('iTop',regex.reg2,tips[1],0))return false;

        // 背景
        if(!checkFormat('bgOpacity',regex.reg3,tips[2],0.5))return false;
        if(!checkFormat('bgHeight',regex.reg1,tips[0],60))return false;

        // 标题
        if(!checkFormat('titleFontSize',regex.reg1,tips[4],25))return false;
        if(!checkFormat('titleFontColor',regex.reg5,tips[5],'#fff'))return false;
        if(!checkFormat('titleLeft',regex.reg2,tips[1],10))return false;
        if(!checkFormat('titleTop',regex.reg2,tips[1],10))return false;

        // 描述
        if(!checkFormat('desFontSize',regex.reg1,tips[4],25))return false;
        if(!checkFormat('desFontColor',regex.reg5,tips[5],'#fff'))return false;
        if(!checkFormat('desLeft',regex.reg2,tips[1],10))return false;
        if(!checkFormat('desTop',regex.reg2,tips[1],10))return false;

        return true;
    }

    function checkFormat(id,reg,tip,defaultValue){
        var node = Tool.$('#'+id);
        var value = node.value;
        if(!reg.test(value)){
            //alert(tip);
            //node.value = defaultValue;
        	Tool.$('#msg').innerHTML=tip;
            node.focus();
            return false;
        }
        return true;
    }
    // change事件
    var inputs = Tool.$('input');
    for (var i = 0, k = inputs.length; i < k; i++) {
        if (inputs[i].type != 'button' && inputs[i].type != 'file'){
            inputs[i].onkeyup = function(){createCanvas(false)};
            inputs[i].onchange = function(){createCanvas(false);console.log(11);};
        }
        if (inputs[i].type == 'file'){
        	inputs[i].onchange = function(){createCanvas(true)};
        }
    }
    
    var selects=Tool.$('select');
    for (var i = 0, k = selects.length; i < k; i++) {
        selects[i].onchange = function(){createCanvas(false)};
    }
    
    
    Tool.$('#putOut').onclick = putOut;
    $('#titleFontColor').iColor();
    $('#desFontColor').iColor();
    // 颜色点击事件
    var labelI = Tool.$('#colorWarp').getElementsByTagName('i');
    for (var j = 0, n = labelI.length; j < n; j++) {
        labelI[j].onclick = function(){
            bgRGB = this.getAttribute('rgb');
            var currents = Tool.$('.current',Tool.$('#colorWarp'));
            Tool.removeClass('current',currents[0]);
            Tool.addClass('current',this);
            createCanvas(false);
        }
    }
    
    //鼠标滑轮事件
    
    $(".wheelable").hover(function(){
		EventUtil.addHandler(document,'mousewheel',onWheel);
		EventUtil.addHandler(document,'DOMMouseScroll',onWheel);
	},
	function(){
		EventUtil.removeHandler(document,'mousewheel',onWheel);
		EventUtil.removeHandler(document,'DOMMouseScroll',onWheel);
	});
    
    //背景透明度
    $(".backwheelable").hover(function(){
		EventUtil.addHandler(document,'mousewheel',onBackWheel);
		EventUtil.addHandler(document,'DOMMouseScroll',onBackWheel);
	},
	function(){
		EventUtil.removeHandler(document,'mousewheel',onBackWheel);
		EventUtil.removeHandler(document,'DOMMouseScroll',onBackWheel);
	});
    
    
 // WITHOUT Plugin
    var EventUtil = {

        addHandler: function(element, type, handler){
            if (element.addEventListener){
                element.addEventListener(type, handler, false);
            } else if (element.attachEvent){
                element.attachEvent("on" + type, handler);
            } else {
                element["on" + type] = handler;
            }
        },
    	
    	removeHandler: function(element, type, handler){
            if (element.removeEventListener){
                element.removeEventListener(type, handler, false);
            } else if (element.detachEvent){
                element.detachEvent("on" + type, handler);
            } else {
                element["on" + type] = null;
            }
        },
    	
    	getEvent: function(event) {
            return event ? event : window.event;
        },
    	
    	getTarget: function(event) {
    		return event.target || event.srcElement;    
    	},
    	
    	getWheelDelta: function(event) {
            if (event.wheelDelta){
                return event.wheelDelta;
            } else {
                return -event.detail * 40;
            }
        },
    	
    	preventDefault: function(event) {
            if (event.preventDefault){
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
        }
        
    };

    function onWheel(event) {

    	event = EventUtil.getEvent(event);
    	var curElem = EventUtil.getTarget(event);
    	var curVal = parseInt(curElem.value);
    	var delta = EventUtil.getWheelDelta(event);
    	
    	if (delta > 0) {
    		curElem.value = curVal + 1;
    	} else{ 
    		curElem.value = curVal - 1;
    	}
    	EventUtil.preventDefault(event);
    	createCanvas(false);
    }
    
    //背景透明度
    function onBackWheel(event) {

    	event = EventUtil.getEvent(event);
    	var curElem = EventUtil.getTarget(event);
    	var curVal = Number(curElem.value);
    	var delta = EventUtil.getWheelDelta(event);
    	console.log(curVal);
    	if (delta > 0) {
    		curElem.value = curVal + 0.1;
    	} else{ 
    		curElem.value = curVal - 0.1;
    	}
    	EventUtil.preventDefault(event);
    	createCanvas(false);
    }

    
}();
