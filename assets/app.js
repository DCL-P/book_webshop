/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/style.scss';

//@ is a scoped npm package, which simply means it is a grouped package under a namespace. This prevents things like duplicate errors etc.
//it is more or less just namespace, but for node_modules
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');