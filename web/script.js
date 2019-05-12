function addStyleSheet(properties) {
  var head = document.getElementsByTagName('head')[0];

  var link = document.createElement('link');
  for (key in properties) {
    link[key] = properties[key];
  }

  head.appendChild(link);
}

// add Font Awesome stylesheet for toggle button
addStyleSheet({
    'rel': 'stylesheet',
    'href': '#',
    'crossorigin': 'anonymous'
});


function toggleCSS() {
  var button = document.getElementById('cssToggleButton');
  if ('fas fa-toggle-off' == button.className) {
    button.classList.replace('fa-toggle-off', 'fa-toggle-on');
    addStyleSheet({'href': 'dark.css', 'rel': 'stylesheet'});
  } else {
    button.classList.replace('fa-toggle-on', 'fa-toggle-off');
    addStyleSheet({'href': 'light.css', 'rel': 'stylesheet'});
  }
}

var div = document.createElement('div');
div.style.position = 'fixed';
div.style.bottom = '5px';
div.style.right = '10px';

var a = document.createElement('a');
a.onclick = toggleCSS;

var label = document.createTextNode('Theme Change');

var span = document.createElement('span');
span.className = 'fas fa-toggle-off';
span.id = 'cssToggleButton';

a.appendChild(label);
a.appendChild(span);

div.appendChild(a);

var body = document.getElementsByTagName('body')[0];
body.appendChild(div);
