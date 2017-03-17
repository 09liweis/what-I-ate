Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
var dashboard = new Vue({
    el: '#dashboard',
    data: {
        heading: 'Welcome to Dashboard',
        currentParentTab: 'food',
        currentTab: 'list',
        newFood: {
            //id: '',
            name: '',
            photo_url: '',
            price: '',
            rating: '',
        },
        location: {
            name: '',
            photo_url: '',
            address: '',
            lat: '',
            lng: '',
            google_place_id: '',
        },
        foods: [],
        map: null,
        service: null,
        searchLocation: '',
        locations: [],
        action: 'add',
    },
    
    computed: {
        // foodErrors: function() {
        //     for (var key in this.newFood) {
        //         if (!this.newFood[key]) return true;
        //     }
        //     return false;
        // },
    },
    
    watch: {
        'searchLocation': function(val) {
            if (val !== '') {
                this.searchLocationFromGoogle();
            }
        }
    },
    
    mounted: function() {
        this.fetchFoods();
        this.map = new google.maps.Map(document.getElementById('map'));
    },
    
    methods: {
        sortFood() {
            this.foods.sort();
        },

        changeParentTab(e) {
            this.currentParentTab = e.target.name;
            e.preventDefault();
        },
        
        searchLocationFromGoogle() {
            var _this = this;
            this.service = new google.maps.places.PlacesService(this.map);
            this.service.textSearch({query: this.searchLocation}, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    _this.locations = results;
                }
            });
        },
        
        selectLocation(location) {
            this.location.name = location.name;
            this.location.address = location.formatted_address;
            this.location.lat = location.geometry.location.lat();
            this.location.lng = location.geometry.location.lng();
            this.location.google_place_id = location.place_id;
        },

        changeTab: function(e) {
            console.log(e.target.name);
            this.currentTab = e.target.name;
            if (this.currentTab == 'list') {
                this.action = 'add';
                this.emptyNewFood();
            } else {
                this.map = new google.maps.Map(document.getElementById('map'));
            }
            this.currentTab = e.target.name;
            e.preventDefault();
        },
        
        emptyNewFood: function() {
            for (var key in this.newFood) {
                this.newFood[key] = '';
            }
        },

        fetchFoods: function() {
            this.$http.get('/user/food').then(function(foods) {
                this.foods = foods.data;
            });
        },
        
        onSubmitForm: function(e) {
            var action = e.target.submit.value;
            e.preventDefault();
            if (action == 'add') {
                this.createFood();
            } else {
                this.updateFood(this.newFood.id);
            }
            this.currentTab = 'list';
            this.action = 'add';
            this.emptyNewFood();
        },
        
        createFood: function() {
            var data = {
                food: this.newFood,
                location: this.location
            };
            this.$http.post('/user/food/create', data).then(function() {
                this.fetchFoods();
            });
        },
        
        editFood: function(id) {
            this.currentTab = 'form';
            this.$http.get('/user/food/' + id).then(function(food) {
                this.newFood = food.data;
                this.currentTab = 'form';
                this.action = 'edit';
            });
        },
        
        updateFood: function(id) {
            var data = {
                food: this.newFood,
                location: this.location
            };
            this.$http.put('/user/food/update/' + id, data).then(function() {
                this.fetchFoods();
                this.currentTab = 'list';
            });
        },
        
        deleteFood: function(id) {
            this.$http.delete('/user/food/delete/' + id).then(function(){
                this.fetchFoods();
            });
        }
    }
});