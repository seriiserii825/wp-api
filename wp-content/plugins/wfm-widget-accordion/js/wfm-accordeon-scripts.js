//http://www.designchemical.com/lab/jquery-vertical-accordion-menu-plugin/options/

jQuery(document).ready(function($){

    if(wfmObj.disableLink === 'on'){
        wfmObj.disableLink = false;
    }else{
        wfmObj.disableLink = true;
    }

    $('#js-wfm-accordeon').dcAccordion({
        'eventType': wfmObj.eventType,
        'disableLink': wfmObj.disableLink,
        'speed': parseInt(wfmObj.speed)
    });

});
