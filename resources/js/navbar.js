Vue.config.devtools = true;

var app = new Vue({
    el: '#nav',
    data: {
        showNav: false,
    },

    methods: {
        showNavToggler: function() {
            this.showNav = !this.showNav;
        }
    },
})
