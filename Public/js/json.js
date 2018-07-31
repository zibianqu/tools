$(function(){
	 $('#json_input').linedtextarea();
	 $('#jy').click(function(){
		 var obj=$('#json_input').val();
		 if(obj==''){
			 $('.json_result').text('');
			 return ; 
		 }
		 json.validateJson()
	 });
	 $("#geshi").click(function(){
		 var obj=$('#json_input').val();
		 if(obj==''){
			 $('.json_result').text('');
			 return ; 
		 }
		 json.formatJson();
	 });
	 $("#suojin").click(function(){
		 var obj=$('#json_input').val();
		 if(obj==''){
			 $('.json_result').text('');
			 return ; 
		 }
		 json.indentJson();
	 });
})


var json={
	_init:function(){
		
	},
	//验证是否是json
	validateJson:function () {
	    var lineNum,
	        lineMatches,
	        lineStart,
	        lineEnd,
	        jsonVal,
	        result;
	        
	    jsonVal = $('#json_input').val();

	    try {
	        result = jsl.parser.parse(jsonVal);
	        
	        if(typeof JSON == 'object'){
	            $('#json_input').val(JSON.stringify(JSON.parse(jsonVal), null, "    "))
	        }else{
	            $('#json_input').val( jsl.format.formatJson(jsonVal) );
	        }

	        if (result) {
//	            $('.v-result').text('正确的 JSON')
//	                .removeClass("alert-danger")
//	                .addClass("alert-success")
//	                .show();
	        	$('.json_result').text('正确的   json');
	        	$('.json_result').removeClass('json_error');
	        	$('.json_result').addClass('json_right');
	        	
	        	$(".lineno").each(function(i,lineno){
	        		$(lineno).removeClass('lineselect');
	        	});
	        } else {
	            alert("An unknown error occurred. Please contact Arc90.");
	        }
	    } catch (parseException) {

	        /** 
	         * If we failed to validate, run our manual formatter and then re-validate so that we
	         * can get a better line number. On a successful validate, we don't want to run our
	         * manual formatter because the automatic one is faster and probably more reliable.
	        **/
	        try {

	            jsonVal = jsl.format.formatJson($('#json_input').val());
	            $('#json_input').val(jsonVal);
	            result = jsl.parser.parse($('#json_input').val());

	        } catch(e) {
	            parseException = e;
	        }

	        lineMatches = parseException.message.match(/line ([0-9]*)/);
	        if (lineMatches && typeof lineMatches === "object" && lineMatches.length > 1) {
	            lineNum = parseInt(lineMatches[1], 10);

	            if (lineNum === 1) {
	                lineStart = 0;
	            } else {
	                lineStart = getNthPos(jsonVal, "\n", lineNum - 1);
	            }

	            lineEnd = jsonVal.indexOf("\n", lineStart);
	            if (lineEnd < 0) {
	                lineEnd = jsonVal.length;
	            }
	            $('#json_input').focus().caret(lineStart, lineEnd);
	        }
	        // select line
	        $(".lineno").eq(lineNum-1).addClass('lineselect');
	        console.log('错误'+(lineNum));
//	        $('.v-result').text(parseException.message)
//	            .removeClass("alert-success")
//	            .addClass("alert-danger")
//	            .show();
	        $('.json_result').text(parseException.message);
	        $('.json_result').removeClass('json_right');
	        $('.json_result').addClass('json_error');
	    }
	},
	formatJson:function(){
		jsonVal = jsl.format.formatJson($('#json_input').val());
        $('#json_input').val(jsonVal);
	},
	indentJson:function(){
		var lineNum,
        lineMatches,
        lineStart,
        lineEnd,
        jsonVal,
        result;
        
    jsonVal = $('#json_input').val();

    try {
        result = jsl.parser.parse(jsonVal);
        
        if(typeof JSON == 'object'){
            $('#json_input').val(JSON.stringify(JSON.parse(jsonVal), null, "    "))
        }else{
            $('#json_input').val( jsl.format.formatJson(jsonVal) );
        }

        if (result) {
        	$("#json_input").val($("#json_input").val().replace(/[ ]/g,"").replace(/[\r\n]/g,""));//去掉回车换行
        	$('.json_result').removeClass('json_error');
        	$('.json_result').text('');
        	$(".lineno").each(function(i,lineno){
        		$(lineno).removeClass('lineselect');
        	});
        } else {
            alert("An unknown error occurred. Please contact Arc90.");
        }
    } catch (parseException) {

        /** 
         * If we failed to validate, run our manual formatter and then re-validate so that we
         * can get a better line number. On a successful validate, we don't want to run our
         * manual formatter because the automatic one is faster and probably more reliable.
        **/
        try {

            jsonVal = jsl.format.formatJson($('#json_input').val());
            $('#json_input').val(jsonVal);
            result = jsl.parser.parse($('#json_input').val());

        } catch(e) {
            parseException = e;
        }

        lineMatches = parseException.message.match(/line ([0-9]*)/);
        if (lineMatches && typeof lineMatches === "object" && lineMatches.length > 1) {
            lineNum = parseInt(lineMatches[1], 10);

            if (lineNum === 1) {
                lineStart = 0;
            } else {
                lineStart = getNthPos(jsonVal, "\n", lineNum - 1);
            }

            lineEnd = jsonVal.indexOf("\n", lineStart);
            if (lineEnd < 0) {
                lineEnd = jsonVal.length;
            }
            $('#json_input').focus().caret(lineStart, lineEnd);
        }
        // select line
        $(".lineno").eq(lineNum-1).addClass('lineselect');
        console.log('错误'+(lineNum));
//        $('.v-result').text(parseException.message)
//            .removeClass("alert-success")
//            .addClass("alert-danger")
//            .show();
        $('.json_result').text(parseException.message);
        $('.json_result').removeClass('json_right');
        $('.json_result').addClass('json_error');
    }
	}
}

function getNthPos(searchStr, char, pos) {
    var i,
        charCount = 0,
        strArr = searchStr.split(char);

    if (pos === 0) {
        return 0;
    }

    for (i = 0; i < pos; i++) {
        if (i >= strArr.length) {
            return -1;
        }

        // +1 because we split out some characters
        charCount += strArr[i].length + char.length;
    }

    return charCount;
}

$.fn.caret = function (begin, end) { 
    if (this.length === 0) {
        return;
    }
    if (typeof begin === 'number') {
        end = (typeof end === 'number') ? end : begin;  
        return this.each(function () {
            if (this.setSelectionRange) {
                this.focus();
                this.setSelectionRange(begin, end);
            } else if (this.createTextRange) {
                var range = this.createTextRange();
                range.collapse(true);
                range.moveEnd('character', end);
                range.moveStart('character', begin);
                range.select();
            }
        });
    } else {
        if (this[0].setSelectionRange) {
            begin = this[0].selectionStart;
            end   = this[0].selectionEnd;
        } else if (document.selection && document.selection.createRange) {
            var range = document.selection.createRange();
            begin = -range.duplicate().moveStart('character', -100000);
            end   = begin + range.text.length;
        }
        return {"begin": begin, "end": end};
    }       
};


