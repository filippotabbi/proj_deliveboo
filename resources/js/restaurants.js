Vue.config.devtools = true;

var app = new Vue({
    el: '#root',
    data: {
        scriviTxt: '',
        restaurants: [],
        categories: [],
        searchResult: [],
        filterResult: [],
        checkClick: false,
        deleteForm: false,
        categorySelected: '',
        search: false,
        page: 1,
        perPage: 9,
        pages: [],
    },
    created() {
        axios.get('http://localhost:8000/api/categories').then((response) => {
            this.categories = response.data.response;
        });

        axios.get('http://localhost:8000/api/restaurants').then((response) => {
            this.restaurants = response.data.response;
        });
    },
    methods: {
        checkReverse: function() {
            this.checkClick = !this.checkClick;
        },
        cerca: function() {
            axios.get(`http://localhost:8000/api/search-restaurant/${this.scriviTxt}`)
                .then((response) => {
                    this.searchResult = response.data.response;
                });
            this.scriviTxt = '';
            this.filterResult = [];
            this.categorySelected = '';
            this.search = true;
            this.pages = [];
            this.page = 1;
            this.setPages();
        },
        filterRestaurants: function (id) {
          this.categorySelected = id;
          axios.get(`http://localhost:8000/api/filter-restaurants/${id}`)
              .then((response) => {
                  this.filterResult = response.data.response;
              });
          this.searchResult = [];
          this.pages = [];
          this.page = 1;
          this.setPages();
        },
        restart: function () {
          this.search = false;
          this.categorySelected = '';
          this.filterResult = [];
          this.searchResult = [];
          this.pages = [];
          this.page = 1;
          this.setPages();
        },
        setPages: function() {
            let numberOfPages = Math.ceil(this.results.length / this.perPage);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
        paginate: function(restaurants) {
            let page = this.page;
            let perPage = this.perPage;
            let from = (page * perPage) - perPage;
            let to = (page * perPage);
            return restaurants.slice(from, to);
        }
    },
    computed: {
        results: function() {
            if (this.categorySelected == '' && !this.search) {
                return this.restaurants;
            } else if (this.categorySelected != '') {
                return this.filterResult;
            } else {
                return this.searchResult;
            }
        },
        displayedResults: function() {
            return this.paginate(this.results);
        },
    },
    watch: {
      restaurants: function () {
        this.setPages();
      },
  	},
})