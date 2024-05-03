/*
 * Function : dump()
 * Arguments: The data - array,hash(associative array),object
 *    The level - OPTIONAL
 * Returns  : The textual representation of the array.
 * This function was inspired by the print_r function of PHP.
 * This will accept some data as the argument and return a
 * text that will be a more readable version of the
 * array/hash/object that is given.
 */
function debug(arr, level) {
    return dump(arr, level);
}

/* ==================================================================================== */

/* ==================================================================================== */
function dump(arr, level) {
    var dumped_text = "";
    if (!level) {
        level = 0;
    }

    /*The padding given at the beginning of the line.*/
    var level_padding = "";
    for (var j = 0; j < level + 1; j++) {
        level_padding += "    ";
    }

    if (arr.constructor == Array || arr.constructor == Object) {
        /*Array/Hashes/Objects*/
        for (var item in arr) {
            var value = arr[item];
            if (value.constructor == Array || value.constructor == Object) {
                /*If it is an array,*/
                /*			dumped_text += level_padding + "[" + item + "] " + typeof(theObj) + " ...\n";*/
                /*			dumped_text += level_padding + "[" + item + "] " + typeof(item) + " ...\n";*/
                dumped_text += level_padding + "[" + item + "] " + ((value.constructor == Array) ? "Array" : "Object") + " ...\n";
                dumped_text += dump(value, level + 1);
            } else {
                dumped_text += level_padding + "[" + item + "] => " + value + "\n";
            }
        } /* fim for(var item in arr) */
    } else {
        /*Stings/Chars/Numbers etc.*/
        dumped_text = "(" + typeof (arr) + ") var: " + arr + "\n";
    }
    return dumped_text;
} /* fim function dump(arr,level) */
/* ==================================================================================== */

/* ==================================================================================== */
function array_key_exists(key, search) {
    //  discuss at: http://phpjs.org/functions/array_key_exists/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Felix Geisendoerfer (http://www.debuggable.com/felix)
    //   example 1: array_key_exists('kevin', {'kevin': 'van Zonneveld'});
    //   returns 1: true

    if (!search || (search.constructor !== Array && search.constructor !== Object)) {
        return false;
    }

    return key in search;
}

/* ==================================================================================== */

/* ==================================================================================== */
function in_array(needle, haystack, argStrict) {
    //  discuss at: http://phpjs.org/functions/in_array/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: vlado houba
    // improved by: Jonas Sciangula Street (Joni2Back)
    //    input by: Billy
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //   example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
    //   returns 1: true
    //   example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
    //   returns 2: false
    //   example 3: in_array(1, ['1', '2', '3']);
    //   example 3: in_array(1, ['1', '2', '3'], false);
    //   returns 3: true
    //   returns 3: true
    //   example 4: in_array(1, ['1', '2', '3'], true);
    //   returns 4: false

    var key = '',
        strict = !!argStrict;

    //we prevent the double check (strict && arr[key] === ndl) || (!strict && arr[key] == ndl)
    //in just one for, in order to improve the performance 
    //deciding wich type of comparation will do before walk array
    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }

    return false;
}

/* ==================================================================================== */

/* ==================================================================================== */
function sleep(segundos) {

    var dataFutura = new Date().getTime() + (segundos * 1000);

    while (new Date().getTime() < dataFutura) {
    }
    return true;
}

/* ==================================================================================== */

/* ==================================================================================== */
function usleep(milisegundos) {

    var dataFutura = new Date().getTime() + milisegundos;

    while (new Date().getTime() < dataFutura) {
    }
    return true;
}

/* ==================================================================================== */

/* ==================================================================================== */
function time_sleep_until(timestamp) { // eslint-disable-line camelcase
    //  discuss at: http://locutus.io/php/time_sleep_until/
    // original by: Brett Zamir (http://brett-zamir.me)
    //      note 1: For study purposes. Current implementation could lock up the user's browser.
    //      note 1: Expects a timestamp in seconds, so DO NOT pass in a JavaScript timestamp which are in milliseconds (e.g., new Date()) or otherwise the function will lock up the browser 1000 times longer than probably intended.
    //      note 1: Consider using setTimeout() instead.
    //   example 1: time_sleep_until(1233146501) // delays until the time indicated by the given timestamp is reached
    //   returns 1: true

    while (new Date() < timestamp * 1000) {
    }
    return true;
}

/* ==================================================================================== */

/* ==================================================================================== */
function strrpos(haystack, needle, offset) {
    //  discuss at: http://phpjs.org/functions/strrpos/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Onno Marsman
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //    input by: saulius
    //   example 1: strrpos('Kevin van Zonneveld', 'e');
    //   returns 1: 16
    //   example 2: strrpos('somepage.com', '.', false);
    //   returns 2: 8
    //   example 3: strrpos('baa', 'a', 3);
    //   returns 3: false
    //   example 4: strrpos('baa', 'a', 2);
    //   returns 4: 2

    var i = -1;
    if (offset) {
        i = (haystack + '')
            .slice(offset)
            .lastIndexOf(needle); // strrpos' offset indicates starting point of range till end,
        // while lastIndexOf's optional 2nd argument indicates ending point of range from the beginning
        if (i !== -1) {
            i += offset;
        }
    } else {
        i = (haystack + '')
            .lastIndexOf(needle);
    }
    return i >= 0 ? i : false;
}

/* ==================================================================================== */

/* ==================================================================================== */
function strripos(haystack, needle, offset) {
    //  discuss at: http://phpjs.org/functions/strripos/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Onno Marsman
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //    input by: saulius
    //   example 1: strripos('Kevin van Zonneveld', 'E');
    //   returns 1: 16

    haystack = (haystack + '')
        .toLowerCase();
    needle = (needle + '')
        .toLowerCase();

    var i = -1;
    if (offset) {
        i = (haystack + '')
            .slice(offset)
            .lastIndexOf(needle); // strrpos' offset indicates starting point of range till end,
        // while lastIndexOf's optional 2nd argument indicates ending point of range from the beginning
        if (i !== -1) {
            i += offset;
        }
    } else {
        i = (haystack + '')
            .lastIndexOf(needle);
    }
    return i >= 0 ? i : false;
}

/* ==================================================================================== */

/* ==================================================================================== */
function substr(str, start, len) {
    //  discuss at: http://phpjs.org/functions/substr/
    //     version: 909.322
    // original by: Martijn Wieringa
    // bugfixed by: T.Wild
    // improved by: Onno Marsman
    // improved by: Brett Zamir (http://brett-zamir.me)
    //  revised by: Theriault
    //        note: Handles rare Unicode characters if 'unicode.semantics' ini (PHP6) is set to 'on'
    //   example 1: substr('abcdef', 0, -1);
    //   returns 1: 'abcde'
    //   example 2: substr(2, 0, -6);
    //   returns 2: false
    //   example 3: ini_set('unicode.semantics',  'on');
    //   example 3: substr('a\uD801\uDC00', 0, -1);
    //   returns 3: 'a'
    //   example 4: ini_set('unicode.semantics',  'on');
    //   example 4: substr('a\uD801\uDC00', 0, 2);
    //   returns 4: 'a\uD801\uDC00'
    //   example 5: ini_set('unicode.semantics',  'on');
    //   example 5: substr('a\uD801\uDC00', -1, 1);
    //   returns 5: '\uD801\uDC00'
    //   example 6: ini_set('unicode.semantics',  'on');
    //   example 6: substr('a\uD801\uDC00z\uD801\uDC00', -3, 2);
    //   returns 6: '\uD801\uDC00z'
    //   example 7: ini_set('unicode.semantics',  'on');
    //   example 7: substr('a\uD801\uDC00z\uD801\uDC00', -3, -1)
    //   returns 7: '\uD801\uDC00z'

    var i = 0,
        allBMP = true,
        es = 0,
        el = 0,
        se = 0,
        ret = '';
    str += '';
    var end = str.length;

    // BEGIN REDUNDANT
    this.php_js = this.php_js || {};
    this.php_js.ini = this.php_js.ini || {};
    // END REDUNDANT
    switch ((this.php_js.ini['unicode.semantics'] && this.php_js.ini['unicode.semantics'].local_value.toLowerCase())) {
        case 'on':
            // Full-blown Unicode including non-Basic-Multilingual-Plane characters
            // strlen()
            for (i = 0; i < str.length; i++) {
                if (/[\uD800-\uDBFF]/.test(str.charAt(i)) && /[\uDC00-\uDFFF]/.test(str.charAt(i + 1))) {
                    allBMP = false;
                    break;
                }
            }

            if (!allBMP) {
                if (start < 0) {
                    for (i = end - 1, es = (start += end); i >= es; i--) {
                        if (/[\uDC00-\uDFFF]/.test(str.charAt(i)) && /[\uD800-\uDBFF]/.test(str.charAt(i - 1))) {
                            start--;
                            es--;
                        }
                    }
                } else {
                    var surrogatePairs = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g;
                    while ((surrogatePairs.exec(str)) != null) {
                        var li = surrogatePairs.lastIndex;
                        if (li - 2 < start) {
                            start++;
                        } else {
                            break;
                        }
                    }
                }

                if (start >= end || start < 0) {
                    return false;
                }
                if (len < 0) {
                    for (i = end - 1, el = (end += len); i >= el; i--) {
                        if (/[\uDC00-\uDFFF]/.test(str.charAt(i)) && /[\uD800-\uDBFF]/.test(str.charAt(i - 1))) {
                            end--;
                            el--;
                        }
                    }
                    if (start > end) {
                        return false;
                    }
                    return str.slice(start, end);
                } else {
                    se = start + len;
                    for (i = start; i < se; i++) {
                        ret += str.charAt(i);
                        if (/[\uD800-\uDBFF]/.test(str.charAt(i)) && /[\uDC00-\uDFFF]/.test(str.charAt(i + 1))) {
                            // Go one further, since one of the "characters" is part of a surrogate pair
                            se++;
                        }
                    }
                    return ret;
                }
                break;
            }
        // Fall-through
        case 'off':
        // assumes there are no non-BMP characters;
        //    if there may be such characters, then it is best to turn it on (critical in true XHTML/XML)
        default:
            if (start < 0) {
                start += end;
            }
            end = typeof len === 'undefined' ? end : (len < 0 ? len + end : len + start);
            // PHP returns false if start does not fall within the string.
            // PHP returns false if the calculated end comes before the calculated start.
            // PHP returns an empty string if start and end are the same.
            // Otherwise, PHP returns the portion of the string from start to end.
            return start >= str.length || start < 0 || start > end ? !1 : str.slice(start, end);
    }
    // Please Netbeans
    return undefined;
}

/* ==================================================================================== */

/* ==================================================================================== */
function str_pad(input, pad_length, pad_string, pad_type) {
    //  discuss at: http://phpjs.org/functions/str_pad/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Michael White (http://getsprink.com)
    //    input by: Marco van Oort
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //   example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
    //   returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
    //   example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
    //   returns 2: '------Kevin van Zonneveld-----'

    var half = '',
        pad_to_go;

    var str_pad_repeater = function (s, len) {
        var collect = '',
            i;

        while (collect.length < len) {
            collect += s;
        }
        collect = collect.substr(0, len);

        return collect;
    };

    input += '';
    pad_string = pad_string !== undefined ? pad_string : ' ';

    if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
        pad_type = 'STR_PAD_RIGHT';
    }
    if ((pad_to_go = pad_length - input.length) > 0) {
        if (pad_type === 'STR_PAD_LEFT') {
            input = str_pad_repeater(pad_string, pad_to_go) + input;
        } else if (pad_type === 'STR_PAD_RIGHT') {
            input = input + str_pad_repeater(pad_string, pad_to_go);
        } else if (pad_type === 'STR_PAD_BOTH') {
            half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
            input = half + input + half;
            input = input.substr(0, pad_length);
        }
    }

    return input;
}

/* ==================================================================================== */

/* ==================================================================================== */
