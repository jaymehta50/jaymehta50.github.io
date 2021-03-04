document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});

    var celems = document.querySelectorAll('.collapsible');
    var cinstances = M.Collapsible.init(celems, {});

    var telems = document.querySelectorAll('.tabs');
    var tinstance = M.Tabs.init(telems, {});

    var ttelems = document.querySelectorAll('.tooltipped');
    var ttinstances = M.Tooltip.init(ttelems, {});

    var melems = document.querySelectorAll('.modal');
    var minstances = M.Modal.init(melems, {});

    window.onpopstate = function(event) {
        showSPAfromhash();
    };

    document.addEventListener('click', function (event) {
        if ( event.target.hasAttribute("data-route") ) {
            var z = event.target;
            window.history.pushState(null, z.getAttribute("data-route"), "#" + z.getAttribute("data-route"));
            showSPA(z.getAttribute("data-route"));
        }
    }, false);

    var ua = window.navigator.userAgent;
    var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
    var webkit = !!ua.match(/WebKit/i);
    var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);

    if (iOSSafari && ("standalone" in window.navigator) && !window.navigator.standalone) {
        M.Modal.getInstance(document.getElementById("iosinstallmodal")).open();
    }

    document.getElementById("autocomplete-input").addEventListener("input", findQrg());

    var deferredPrompt;

    window.addEventListener('beforeinstallprompt', function (e) {
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;

        document.getElementById("androidinstall").style.display = "block";
        document.getElementById("navbar").classList.add("stylewithinstallprompt");
    });

    document.getElementById("androidprompt").addEventListener('click', function (e) {
        // hide our user interface that shows our A2HS button
        document.getElementById("androidinstall").style.display = "none";
        document.getElementById("navbar").classList.remove("stylewithinstallprompt");
        // Show the prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice
            .then(function (choiceResult) {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the A2HS prompt');
                } else {
                    console.log('User dismissed the A2HS prompt');
                }
                deferredPrompt = null;
            });
    });

    if (storageAvailable('localStorage')) {
        for (var i = 1; i <= 6; i++) {
            if(!localStorage.getItem("readinessitem"+i)) {
                // data not yet set
                changeReadiness(i, false);
                localStorage.setItem("readinessitem"+i, "false");
            }
            else if (localStorage.getItem("readinessitem"+i)=="false") {
                // This item not yet done
                changeReadiness(i, false);
            }
            else {
                // This item not yet done
                changeReadiness(i, true);
            }
        }
    }

    showSPAfromhash();
});

if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        var swRegistration = registerServiceWorker();
    });
}

function registerServiceWorker() {
    return navigator.serviceWorker.register('sw.js').then(function(registration) {
      // Registration was successful
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
      return registration;
    }, function(err) {
      // registration failed :(
      console.log('ServiceWorker registration failed: ', err);
    });
}

// function askPermission() {
//   return new Promise(function(resolve, reject) {
//     const permissionResult = Notification.requestPermission(function(result) {
//       resolve(result);
//     });

//     if (permissionResult) {
//       permissionResult.then(resolve, reject);
//     }
//   })
//   .then(function(permissionResult) {
//     if (permissionResult !== 'granted') {
//       throw new Error('We weren\'t granted permission.');
//     }
//   });
// }

// function subscribeUserToPush() {
//   return navigator.serviceWorker.register('service-worker.js')
//   .then(function(registration) {
//     const subscribeOptions = {
//       userVisibleOnly: true,
//       applicationServerKey: urlBase64ToUint8Array(
//         'BEl62iUYgUivxIkv69yViEuiBIa-Ib9-SkvMeAtA3LFgDzkrxZJjSgSnfckjBJuBkr3qBUYIHBQFLXYp5Nksh8U'
//       )
//     };

//     return registration.pushManager.subscribe(subscribeOptions);
//   })
//   .then(function(pushSubscription) {
//     console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
//     return pushSubscription;
//   });
// }

// Show single page app section
function showSPA(spaname) {
    // Hide currently visible section
    var x = document.getElementsByClassName("spa-section");
    for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("spa-active");
    }

    // Does spaname reference a section that actually exists? If yes show it, if not show home
    var y = document.getElementById(spaname);
    if (y != null && spaname != "") {
        y.classList.add("spa-active");
    }
    else {
        document.getElementById("home").classList.add("spa-active");
        spaname = "home";
    }
    document.title = "RFG EPR Guide - " + spaname.charAt(0).toUpperCase() + spaname.slice(1);
    window.scrollTo(0,0);

    // If this section has corresponding links in navbar, make them active
    var matches = document.querySelectorAll("a[data-route]");
    for (var i = 0; i < matches.length; i++) {
        if(matches[i].parentElement.nodeName == "LI") {
            matches[i].parentElement.classList.remove("active");
            if(matches[i].getAttribute("data-route") == spaname) {
                matches[i].parentElement.classList.add("active");
            }
        }
    }
}

// Get the current hash from URL and show appropriate section based on this
function showSPAfromhash() {
    // Is hash defined? If not show home page
    if(typeof window.location.hash != "undefined") {
        showSPA(window.location.hash.substr(1));
    }
    else {
        showSPA("home");
    }
}

function toggleReadiness(no) {
    changeReadiness(no, (document.getElementById("ready"+no+"yes").style.display == "none"));
}

function changeReadiness(no, activating) {
    if (activating) {
        document.getElementById("ready"+no+"no").style.display = "none";
        document.getElementById("ready"+no+"yes").style.display = "block";
        document.getElementById("btnreadiness"+no).innerHTML = "Mark as Incomplete";
        if (storageAvailable('localStorage')) {
            localStorage.setItem("readinessitem"+no, "true");
        }
    }
    else {
        document.getElementById("ready"+no+"yes").style.display = "none";
        document.getElementById("ready"+no+"no").style.display = "block";
        document.getElementById("btnreadiness"+no).innerHTML = "Mark as Complete";
        if (storageAvailable('localStorage')) {
            localStorage.setItem("readinessitem"+no, "false");
        }
    }
}

function storageAvailable(type) {
    try {
        var storage = window[type],
            x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return e instanceof DOMException && (
            // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            storage.length !== 0;
    }
}

function nextquestion(i, j) {
    var els = document.querySelectorAll('div#sscq'+j+' ~ div.sscq-active');
    if (els.length > 0) {
        console.log(els);
        for (var k = 0; k < els.length; k++) {
            els[k].classList.remove("sscq-active");
        }
    }
    
    document.getElementById("sscq"+i).classList.add("sscq-active");
    window.scrollBy(0, document.getElementById("sscq"+j).offsetHeight);
}

function findQrg() {
    var searchstr = document.getElementById("autocomplete-input").value;

    var matches = document.querySelectorAll("div[data-search]");
    for (var i = 0; i < matches.length; i++) {
        if(searchstr=="") matches[i].style.display = "block";
        else {
            if(matches[i].getAttribute("data-search").toUpperCase().indexOf(searchstr.toUpperCase()) > -1) {
                matches[i].style.display = "block";
            }
            else {
                matches[i].style.display = "none";
            }
        }
    }
}