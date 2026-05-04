window.onload = function () {
	

	
	
    // Main content autoheight
    var main = document.getElementsByTagName('main')[0];
    if (main) {
        adjustMainHeight();
        window.addEventListener('resize', adjustMainHeight);
    }
    function adjustMainHeight() {
        var windowHeight = window.innerHeight;
        var headerHeight = document.getElementById('gdev-header').offsetHeight;
        var footerHeight = document.getElementById('gdev-footer').offsetHeight;
        var contentHeight = windowHeight - headerHeight - footerHeight;
        main.style.minHeight = contentHeight + 'px';
    }

    // Lazysizes bg
    function loadJS(u) { var r = document.getElementsByTagName("script")[0], s = document.createElement("script"); s.src = u; r.parentNode.insertBefore(s, r); }

    if (!window.HTMLPictureElement || !('sizes' in document.createElement('img'))) {
        loadJS("ls.respimg.min.js");
    }

    
    
    if (document.querySelectorAll(".infos-slideup").length > 0) {
        var elements = document.querySelectorAll(".infos-slideup");
        elements.forEach(element => {
          element.setAttribute("data-aos", "fade-up");
        });
    }

    if (document.querySelectorAll(".infos-slideright").length > 0) {
        var elementsRight = document.querySelectorAll(".infos-slideright");
        elementsRight.forEach(element => {
          element.setAttribute("data-aos", "fade-right");
        });
    }

    if (document.querySelectorAll(".infos-slideleft").length > 0) {
        var elementsLeft = document.querySelectorAll(".infos-slideleft");
        elementsLeft.forEach(element => {
          element.setAttribute("data-aos", "fade-left");
        });
    }
      
    AOS.init();
};











