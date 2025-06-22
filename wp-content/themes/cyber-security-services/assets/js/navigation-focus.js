var cyber_security_services_Keyboard_loop = function (elem) {
  var cyber_security_services_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
  var cyber_security_services_firstTabbable = cyber_security_services_tabbable.first();
  var cyber_security_services_lastTabbable = cyber_security_services_tabbable.last();
  cyber_security_services_firstTabbable.focus();

  cyber_security_services_lastTabbable.on('keydown', function (e) {
    if ((e.which === 9 && !e.shiftKey)) {
      e.preventDefault();
      cyber_security_services_firstTabbable.focus();
    }
  });

  cyber_security_services_firstTabbable.on('keydown', function (e) {
    if ((e.which === 9 && e.shiftKey)) {
      e.preventDefault();
      cyber_security_services_lastTabbable.focus();
    }
  });

  elem.on('keyup', function (e) {
    if (e.keyCode === 27) {
      elem.hide();
    };
  });
};