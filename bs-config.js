const urlapi = require('url');
const siteUrl = 'http://site-url.com/', // example `http://site-url.com/`
    themeName = 'flexible'; // example `project-name`
const URL = urlapi.parse(siteUrl);

module.exports = {
    'files': ['assets/css/*.css', '*.php', 'template-parts/**/*.php', 'templates/*.php', 'assets/js/*.js'],
    'proxy': siteUrl,
    'serveStatic': ['./'],

    rewriteRules: [
        {
            match: new RegExp(URL.path.substr(1) + 'wp-content/themes/' + themeName + '/assets/css'),
            fn: function () {
                return 'assets/css';
            }
        },
        {
            match: new RegExp(URL.path.substr(1) + 'wp-content/themes/' + themeName + '/assets/css/main.css'),
            fn: function () {
                return 'assets/css/main.css';
            }
        }
    ]
};
