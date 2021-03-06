function generate() {
    this.error = [];
    this.string = "";
    this._isMail = function(e) {
        var t = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        return t.test(e)
    };
    this._isTeleNum = function(e) {
        var t = /^(13[0-9]{9})|(15[89][0-9]{8})$/;
        return t.test(e)
    };
    this._isUrl = function(e) {
        var t = "^((https|http|ftp|rtsp|mms)?://)" + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" + "(([0-9]{1,3}.){3}[0-9]{1,3}" + "|" + "([0-9a-z_!~*'()-]+.)*" + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]." + "[a-z]{2,6})" + "(:[0-9]{1,4})?" + "((/?)|" + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";
        var n = new RegExp(t);
        return n.test(e)
    };
    this.getString = function() {
        return this.string
    };
    this.getError = function() {
        return this.error
    }
}
function Mode_text() {
    generate.apply(this);
    var e = $.trim($("#text_text").val());
    if (!e) this.error.push("文本不能为空!");
    this.string = e
}
function Mode_url() {
    generate.apply(this);
    var e = $.trim($("#url_url").val());
    if (!e || e == "http://") this.error.push("网址不能为空!");
    this.string = e
}
function Mode_weixin() {
    generate.apply(this);
    var e = $.trim($("#url_url").val());
    if (e) {
        this.string = "weixin://profile/" + e
    }
}
function Mode_telephone() {
    generate.apply(this);
    var e = $.trim($("#telephone_tel").val());
    if (!e) this.error.push("电话号码不能为空!");
    if (e) {
        this.string = "tel:" + e
    }
}
function Mode_sms() {
    generate.apply(this);
    var e = $.trim($("#sms_tel").val());
    if (!e) this.error.push("电话号码不能为空!");
    var t = $.trim($("#sms_sms").val());
    if (!t) this.error.push("短信不能为空!");
    if (e) this.string += "smsto:" + e + ":";
    if (t) this.string += t
}
function Mode_card() {
    generate.apply(this);
    var e = $.trim($("#card_n").val());
    var t = $.trim($("#card_org").val());
    var n = $.trim($("#card_til").val());
    var r = $.trim($("#card_tel").val());
    var i = $.trim($("#card_phone").val());
    var s = $.trim($("#card_url").val());
    var o = $.trim($("#card_mail").val());
    var u = $.trim($("#card_adr").val());
    var a = $.trim($("#car_note").val());
    if (!e) this.error.push("姓名不能为空!");
    if (!r) this.error.push("电话号码不能为空!");
    if (!this._isTeleNum(r)) this.error.push("无效的电话号码！");
    if (!t) this.error.push("单位不能为空!");
    if (!n) this.error.push("职位不能为空!");
    if (!s) this.error.push("网址不能为空!");
    if (!this._isUrl(s)) this.error.push("无效的网址");
    if (!o) this.error.push("邮箱不能为空!");
    if (!this._isMail(o)) this.error.push("无效的邮箱!");
    if (!u) this.error.push("地址不能为空!");
    if (s == "http://") s = "";
    if (e || r || i || t || n || s || o || u || a) {
        this.string = "MECARD:";
        if (r) this.string += "TEL:" + r + ";";
        if (i) this.string += "TEL:" + i + ";";
        if (s) this.string += "URL:" + s + ";";
        if (o) this.string += "EMAIL:" + o + ";";
        if (a) this.string += "NOTE:" + a + ";";
        if (e) this.string += "N:" + e + ";";
        if (t) this.string += "ORG:" + t + ";";
        if (n) this.string += "TIL:" + n + ";";
        if (u) this.string += "ADR:" + u + ";"
    }
}
function Mode_mail() {
    generate.apply(this);
    var e = $.trim($("#mail_mail").val());
    if (!e) this.error.push("邮箱不能为空!");
    if (!this._isMail(e)) this.error.push("无效邮箱!");
    this.string = e
}
function Mode_wifi() {
    generate.apply(this);
    var e = $.trim($("#wifi_ssid").val());
    var t = $.trim($("#wifi_p").val());
    var n = $.trim($("#wifi_t").val());
    if (!e) this.error.push("ssid账号不能为空!");
    if (e || t) {
        this.string = "WIFI:";
        if (e) this.string += "S:" + e + ";";
        if (n) this.string += "T:" + n + ";";
        if (t) this.string += "P:" + t + ";"
    }
}
function Mode_map() {
    generate.apply(this);
    this.string = $.trim($("#map_map").val())
}
function countSize(e, t) {
    var n = e.val().length;
    e.next().children("span").text(n)
}
function defalutText(e, t) {
    if (e.val() == t) {
        e.addClass("default")
    }
    e.focus(function() {
        if (e.val() == t) {
            e.val("").removeClass("default")
        }
    });
    e.blur(function() {
        if (e.val() == "") {
            e.val(t).addClass("default")
        }
    })
}