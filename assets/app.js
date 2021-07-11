import './styles/app.scss';

window.radioEnable = function(elementId) {
    $("#"+elementId).prop("checked", true);
}