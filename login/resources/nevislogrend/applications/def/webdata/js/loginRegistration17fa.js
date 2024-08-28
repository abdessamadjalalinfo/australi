
(function() {

    var getTargetUrl = function () {
        var matches = window.location.search.match('.*targetURL=\([^&]*\).*');
        return matches && matches[1];
    };

    var handlerFactory = function (label, primaryCategory) {
        return function () {
            try {
                if(utag) {
                    utag.link(
                        {
                            'event_attributes_loc': 'page',
                            'event_eventInfo_cause': 'click',
                            'event_eventInfo_effect': 'go-to',
                            'event_attributes_tgtURL': getTargetUrl(),
                            'event_eventInfo_eventLabel': label,
                            'event_category_primaryCategory': primaryCategory
                        });
                }
            } catch (e) {
                console.log(e);
            }
        };
    };

    document.getElementById('externalIDP').addEventListener('click', handlerFactory('login mit swissid', 'login - swissid'), false);
    document.getElementById('actionLogin').addEventListener('click', handlerFactory('einloggen', 'login - klp'), false);
})();