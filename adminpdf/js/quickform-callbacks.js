/*-----------------------------------------------------
        checkdataDate
-----------------------------------------------------*/
function checkdataDate(date) {
    a = date.toString().split('/');
    d = a[0];
    m = a[1];
    y = a[2];
    
    return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
}

function checkdataUrl(url){
    if (url.length > 0){
        return  /^(http:\/\/|https:\/\/)?(www\.)?(\w+)\.(\w+)/i.test(url);
    }
    else return true;
}

function checkSizeImg(img){

    return true;
}
function checkOption(element, checked) {
    var val = $('[name="mandatory_options"]');
    if (val.is(':checked')) {
        if ($('.option-item input:checked').length > 0) {

            return true;
        }else{
            showMessage('w',24,0);
            return false;

        }

    } else{
        return true;
    }//return false;
   /* if (element && !checked) {
        //  return false;
    }*/
    //return true;
}

