;(function() {
    var matched, browser;

    // Use of jQuery.browser is frowned upon.
    // More details: http://api.jquery.com/jQuery.browser
    // jQuery.uaMatch maintained for back-compat
    jQuery.uaMatch = function( ua ) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
            /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
            /(msie) ([\w.]+)/.exec( ua ) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
            [];

        return {
            browser: match[ 1 ] || "",
            version: match[ 2 ] || "0"
        };
    };

    matched = jQuery.uaMatch( navigator.userAgent );
    browser = {};

    if ( matched.browser ) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
    }

    // Chrome is Webkit, but Webkit is also Safari.
    if ( browser.chrome ) {
        browser.webkit = true;
    } else if ( browser.webkit ) {
        browser.safari = true;
    }

    jQuery.browser = browser;
})();

(function(){

    var Storage = function(){
        if(jQuery.browser.msie){
            this.IEInit(); 
        } 
    };

    Storage.prototype.supportsLocalStorage = function(){
            return window["localStorage"] !== null && ("localStorage" in window);
    };

    Storage.prototype.setItem = function(key,value){
        if(this.supportsLocalStorage()){
              localStorage.setItem(key,value);  
        }else{
            if(jQuery.browser.msie){
                try{
                    this.oUserData.load("renrenUserData"); 
                    this.oUserData.setAttribute(key,value);
                    this.oUserData.save("renrenUserData");
                }catch(e){
                
                }    
            
            } 
        }
    };

    Storage.prototype.getItem = function(key){
        if(this.supportsLocalStorage()){
            return localStorage.getItem(key); 
        }else{
            if(jQuery.browser.msie){
                try{
                    this.oUserData.load("renrenUserData"); 
                    return this.oUserData.getAttribute(key);
                }catch(e){
                } 
            } 
        }
    };

    Storage.prototype.removeItem = function(key){
        if(this.supportsLocalStorage()){
            localStorage.removeItem(key); 
        }else{
            if(jQuery.browser.msie){
                try{
                    this.oUserData.load("renrenUserData");
                    this.oUserData.removeAttribute(key);
                    this.oUserData.save("renrenUserData"); 
                }catch(e){}
            } 
        }
    };

    Storage.prototype.clear = function(){
        if(this.supportsLocalStorage()){
            localStorage.clear(); 
        }else{
            if(jQuery.browser.msie){
                var d = new Date(); 
                d.setDate(d.getDate()-100);
                userData.load("renrenUserData");
                userData.expires = d.toUTString();
                userData.save("renrenUserData");
            } 
        }
    };
    
    Storage.prototype.IEInit = function(){
        this.oUserData = document.createElement("div");
        this.oUserData.setAttribute("id","renrenUserData");
        this.oUserData.style.behavior = "url('#default#userData')";
        $("body").append(this.oUserData);
    };

    window.LS = new Storage();
    var dom = $('#J-reg-num li');

    var countNum = Number(LS.getItem('countNum')) || 12153;

    if(!countNum) {
        LS.setItem('countNum', 12153);
    }

    countNum = countNum.toString();

    for (var i = 0; i < dom.size(); i++) {
        var cha = dom.size() - countNum.length;
        dom.eq(i + cha).text(countNum.substr(i,1) ? countNum.substr(i,1) : 0);
    };

    setInterval(function(){
        var random = Math.floor(Math.random() * 3 + 1); 
        countNum = Number(countNum);

        countNum += random;
        countNum = countNum.toString();
        LS.setItem('countNum', countNum);

        for (var i = 0; i < dom.size(); i++) {
            var cha = dom.size() - countNum.length;
            dom.eq(i + cha).text(countNum.substr(i,1) ? countNum.substr(i,1) : 0);
        };
    }, 3800);
})(jQuery);

