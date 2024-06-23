function showLoader() {
    document.getElementById('loader').style.display = 'block';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
}

window.onload = function() {
    hideLoader();
};

window.onbeforeunload = function() {
    showLoader();
};

window.fetch = (function(fetch) {
    return function() {
        showLoader();
        return fetch.apply(this, arguments).finally(hideLoader);
    };
})(window.fetch);


$(document).ajaxStart(function() {
    showLoader();
}).ajaxStop(function() {
    hideLoader();
});