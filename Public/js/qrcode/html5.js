var canvas = document.getElementById("canvas");
if (canvas && canvas.getContext) {
    if ($.browser.msie && $.browser.version == "9.0") {
        $(".pic").text("开启此功能，请选用谷歌、火狐、Opera、Safari打开")
    }
    var canvasObj = new createQRImage("canvas");
    _init();//初始化二维码
    function _init(){
        canvasObj.changeWidth($("#size").val());
        getround();
        canvasObj.drawImage();
    }
    setDefault();
    function emptyFn() {}
    function getStr(e) {
        var t = new window["Mode_" + e];
        return {
            str: t.getString(),
            error: t.getError()
        }
    }
    var timerCache = null;
    function execCanvas(e) {
        clearTimeout(timerCache);
        timerCache = setTimeout(e || emptyFn, 500)
    }
    function checkMode(e, t) {
        t = t || emptyFn;
        var n = getStr(e);
        var r = n.str;
        var i = [];
        i = n.error;
        if (e == "text" && r == "支持文本、网址和电子邮箱") {
            i.push("文本不能为空");
            r = ""
        } else if (e == "url" && r == "http://") {
            i.push("文本不能为空");
            r = ""
        }
        $("#apiText").attr("title", r);
        execCanvas(function() {
            canvasObj.changeText(r || "http://www.mytuer.com/", t)
        })
    }
    function getround() {
        if ($("#diy_dot")[0]) {
            var e = parseInt($("#diy_dot").css("left")) + 5;
            var t = Math.abs(135 - e) / 135 * .5;
            var n = e <= 135 ? true: false;
            canvasObj.setRound(n, t)
        }
    }
    $("#text_text").bind({
        change: function() {
            if ($(this).val() != "支持文本、网址和电子邮箱") {
                countSize($(this));
                checkMode("text", getround)
            }
        },
        keyup: function() {
            $(this).trigger("change")
        },
        paste: function() {
            var e = $(this);
            setTimeout(function() {
                e.trigger("change")
            },
            100)
        }
    });
    $("#card_n,#card_tel,#card_phone,#car_note,#card_org,#card_til,#card_mail,#card_adr,#card_url").keyup(function() {
        checkMode("card", getround)
    });
    $("#hidetel").click(function() {
        checkMode("card", getround)
    });
    $("#sms_tel").keyup(function() {
        checkMode("sms", getround)
    });
    $("#sms_sms").keyup(function() {
        var e = $(this).val().length;
        $("#sms_len").text(e);
        checkMode("sms", getround)
    });
    $("#wifi_ssid,#wifi_p").keyup(function() {
        checkMode("wifi", getround)
    });
    $("#wifi_t").change(function() {
        checkMode("wifi", getround)
    });
    $("#url_url").keyup(function() {
        checkMode("url", getround);
    });
    $("#telephone_tel").keyup(function() {
        checkMode("telephone", getround)
    });
    $("#mail_mail").keyup(function() {
        checkMode("mail", getround)
    });
    $(".content .ctext").bind({
        focus: function() {
            if ($(this).val() == "输入文本") {
                $(this).val("")
            }
        },
        blur: function() {
            if ($(this).val() == "") {
                $(this).val("")
            }
        }
    });
    $("#fntab li").click(function() {
        var e = $(this).attr("rel");
        checkMode(e, getround)
    });
    $("#level").change(function() {
        canvasObj.changeLevel($(this).val())
    });
    $("#margin").change(function() {
        canvasObj.changeMargin($(this).val())
    });
    $("#rotate").change(function() {
        canvasObj.changeRotate($(this).val())
    });
    $("#gradientWay").change(function() {
        canvasObj.changeGradientWay($(this).val(), $("#gccolor").val())
    });
    $("#foreground").change(function(e) {
        canvasObj.changeForeground(e)
    });
    $("#background").change(function(e) {
        canvasObj.changeBackground(e)
    });
    $("#logotypes").change(function(e) {
        var t = $('input[name="logotype"]:checked').val();
        canvasObj.changeLogotype(t)
    });
    $("#logoimg").change(function(e) {
        var t = $('input[name="logotype"]:checked').val();
        $("#level").val("H").attr("disabled", "disabled");
        canvasObj.changeLogoimg(e, t)
    });
    $("#gradientWay").change(function() {
        var e = $("#gradientWay").val();
        var t = e ? $("#gccolor").val() : null;
        canvasObj.changeGcColor(e, t)
    });
    $("#resetBgColor").click(function() {
        canvasObj.resetBgColor()
    });
    $("#resetFgColor").click(function() {
        canvasObj.resetFgColor()
    });
    $("#resetPtColor").click(function() {
        canvasObj.resetPtColor();
        $("#icp_ptcolor").css("background-color", "#000");
        $(this).hide()
    });
    $("#resetInPtColor").click(function() {
        canvasObj.resetInPtColor();
        $("#icp_inptcolor").css("background-color", "#000");
        $(this).hide()
    });
    $("#resetGcColor").click(function() {
        canvasObj.resetGcColor();
        $("#icp_gccolor").css("background-color", "#000");
        $(this).hide()
    });
    $("#resetMargin").click(function() {
        canvasObj.resetMargin()
    });
    $("#resetWidth").click(function() {
        canvasObj.resetWidth()
    });
    $("#resetBackground").click(function() {
        $("#background").val("");
        canvasObj.resetBackground()
    });
    $("#resetForeground").click(function() {
        $("#foreground").val("");
        canvasObj.resetForeground()
    });
    $("#resetLogoimg").click(function() {
        $("#logoimg").val("");
        $("#picelem").hide();
        $("#format").show();
        $("#turn").hide();
        canvasObj.resetLogoimg(function() {
            $("#level")[0].options[0].selected = true;
            $("#level").removeAttr("disabled")
        })
    });
    $("#resetRound").click(function() {
        canvasObj.resetRound();
        $("#diy_dot").attr("style", "")
    });
    $("#resetRound1").click(function() {
        $("#diy_dot").css("left", "-5px");
        canvasObj.changeRound(true, .5)
    });
    $("#resetRound2").click(function() {
        $("#diy_dot").css("left", "265px");
        canvasObj.changeRound(false, .5)
    });
    $("#resetAll").click(function() {
    	
        $("#logoimg").val("");
        canvasObj.resetAll();
        resetAll();
    });
    var isScrolled = false;
    var startX = 0,
    startLevel = 0;
    $("#diy_dot").bind({
        mousedown: function(e) {
            isScrolled = true;
            startX = e.clientX;
            startLevel = e.target.offsetLeft + 5
        },
        mouseup: function(e) {
            isScrolled = false;
            startLevel = e.target.offsetLeft + 5
        }
    });
    $(document).bind({
        mousemove: function(e) {
            if (isScrolled) {
                var t = startLevel + e.clientX - startX;
                t = t > 270 ? 270 : t < 0 ? 0 : t;
                $("#diy_dot").attr("style", "left:" + (t - 5) + "px");
                var n = Math.abs(135 - t) / 135 * .5;
                var r = t <= 135 ? true: false;
                canvasObj.changeRound(r, n)
            }
        },
        mouseup: function() {
            isScrolled = false
        }
    });
    $("#savepng").click(function() {
        canvasObj.getBase64(function(e) {
            $("#pngdata").val(e);
            $("#form").submit()
        })
    });
    $("#cbutton").click(function() {
        var e = $.trim($("#ctext").val());
        if (e == "输入文本") {
            e = ""
        }
        if (e == "") {
            $("#resetContent").css("display", "none");
            $("#level")[0].options[0].selected = true;
            $("#level").removeAttr("disabled");
            canvasObj.changeLevel("L")
        } else {
            $("#resetContent").css("display", "block");
            $("#level").val("H").attr("disabled", "disabled");
            canvasObj.changeLevel("H")
        }
        canvasObj.changeContent(e)
    });
    $("#resetContent").click(function() {
        $(this).css("display", "none");
        canvasObj.resetContent(function() {
            $("#level")[0].options[0].selected = true;
            $("#level").removeAttr("disabled")
        })
    });
    $("#resetFtColor").click(function() {
        canvasObj.resetFtColor();
        $("#icp_ftcolor").css("background-color", "#000");
        $(this).hide()
    });
    $("#fonteffect").change(function() {
        canvasObj.changeFontEffect($(this).val())
    });
    $("#fontsize").change(function() {
        canvasObj.changeFontSize($(this).val())
    });
    $("#size").keyup(function() {
    	if($(this).val()>800){
    		$(this).val(800);
    	}else if($(this).val()<80){
    		return;
    	}
    	$('#canvas').css('width','230');
    	$('#canvas').css('height','230');
    	
        canvasObj.changeWidth($(this).val());
        getround();
        canvasObj.drawImage()
    });
    $("#pin-trigger").hover(function() {
        var e = $(this).offset().top;
        var t = $(this).offset().left;
        $(this).addClass("pin-trigger-on");
        $("#pin-panel").show().css({
            left: t - 254,
            top: e + 34
        })
    });
    $("#pin-panel").mouseleave(function() {
        $("#pin-trigger").removeClass("pin-trigger-on");
        $(this).hide()
    });
    $("#pin-panel li").click(function() {
        $(this).addClass("active").siblings().removeClass("active");
        canvasObj.changePtImage($(this).index())
    })
}