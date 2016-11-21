
function setphonehop()
{
     $("input[name=cphone]").keyup(function() {
        if( this.value.length >= 3 ) $(this).parent().next().find("input").focus();
    });  

    $("input[name=cphone_comment]").keyup(function() {
        if( this.value.length >= 3 ) $(this).parent().next().find("input").focus();
    });  
}

function set_cntcomment()
{
    var textarea = document.getElementById("bt_comment");
    var result   = document.getElementById("cnt_comment");
    var max_text = 400;

    textarea.addEventListener("input", function() {

        var v = wordCount( this.value );

        if( v.characters <= max_text )
        {
            result.innerHTML = v.characters;
        }
        else
        {
            this.value = this.value.substring(0, max_text);
        }
        /*
        result.innerHTML = (
          "<br>Characters (no spaces):  "+ v.charactersNoSpaces +
          "<br>Characters (and spaces): "+ v.characters +
          "<br>Words: "+ v.words +
          "<br>Lines: "+ v.lines
        );
        */

    }, false);
}


function set_cntplan()
{
    var textarea = document.getElementById("bt_plan");
    var result   = document.getElementById("cnt_plan");
    var max_text = 400;

    textarea.addEventListener("input", function() {

        var v = wordCount( this.value );

        if( v.characters <= max_text )
        {
            result.innerHTML = v.characters;
        }
        else
        {
            this.value = this.value.substring(0, max_text);
        }
        /*
        result.innerHTML = (
          "<br>Characters (no spaces):  "+ v.charactersNoSpaces +
          "<br>Characters (and spaces): "+ v.characters +
          "<br>Words: "+ v.words +
          "<br>Lines: "+ v.lines
        );
        */

    }, false);
}


function wordCount( val )
{
    var wom = val.match(/\S+/g);
    return {
        charactersNoSpaces : val.replace(/\s+/g, '').length,
        characters         : val.length,
        words              : wom ? wom.length : 0,
        lines              : val.split(/\r*\n/).length
    };
}

