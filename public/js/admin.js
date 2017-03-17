Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
var dashboard = new Vue({
    el: '#admin',
    data: {
        currentParentTab: 'location',
        currentTab: 'list',
        newLocation: {
            name: '',
            photo_url: '',
            address: '',
            lat: '',
            lng: '',
            google_place_id: '',
            photos: [],
        },
        map: null,
        service: null,
        searchLocation: '',
        locations: [],
        searchLocations: [],
        action: 'add',
        selectedPhoto: ''
    },
    
    computed: {
        // locationErrors: function() {
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
        this.fetchLocations();
    },
    
    methods: {
        
        selectPhoto(photo) {
            this.selectedPhoto = photo;
        },
        
        confirmPhoto() {
            this.newLocation.photo_url = this.selectedPhoto;
            this.selectedPhoto = '';
        },

        initGoogleService() {
            this.map = new google.maps.Map(document.getElementById('map'));
            this.service = new google.maps.places.PlacesService(this.map);
        },
        
        pullFromGoogle(e) {
            e.preventDefault();
            var _this = this;
            var request = {placeId: this.newLocation.google_place_id};

            this.service.getDetails(request, function(location, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    _this.renderForm(location);
                }
            });
        },
        
        renderForm(location) {
            this.newLocation.name = location.name;
            this.newLocation.address = location.formatted_address;
            this.newLocation.lat = location.geometry.location.lat();
            this.newLocation.lng = location.geometry.location.lng();
            this.newLocation.google_place_id = location.place_id;
            var photos = [];
            location.photos.map(function(photo) {
                photos.push(photo.getUrl({maxWidth: 400, maxHeight: 300}));
            });
            this.newLocation.photos = photos;
        },
        
        changeParentTab(e) {
            this.currentParentTab = e.target.name;
            e.preventDefault();
        },
        
        searchLocationFromGoogle() {
            var _this = this;
            this.service.textSearch({query: this.searchLocation}, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    _this.searchLocations = results;
                }
            });
        },
        
        selectLocation(location) {
            this.renderForm(location);
        },

        changeTab: function(e) {
            this.currentTab = e.target.name;
            if (this.currentTab == 'list') {
                this.action = 'add';
                this.emptyLocation();
            } else {
                this.initGoogleService();
            }
            this.currentTab = e.target.name;
            e.preventDefault();
        },
        
        emptyLocation: function() {
            for (var key in this.newLocation) {
                this.newLocation[key] = '';
            }
        },

        fetchLocations: function() {
            this.$http.get('/admin/locations').then(function(locations) {
                this.locations = locations.data;
            });
        },
        
        onSubmitForm: function(e) {
            var action = e.target.submit.value;
            e.preventDefault();
            if (action == 'add') {
                this.createLocation();
            } else {
                this.updateLocation(this.newLocation.id);
            }
            this.currentTab = 'list';
            this.action = 'add';
            this.emptyLocation();
        },
        
        createLocation: function() {

            this.$http.post('/admin/location/create', this.newLocation).then(function() {
                this.fetchLocations();
            });
        },
        
        editLocation: function(id) {
            this.initGoogleService();
            this.currentTab = 'form';
            this.$http.get('/admin/location/' + id).then(function(location) {
                this.newLocation = location.data;
                this.currentTab = 'form';
                this.action = 'edit';
            });
        },
        
        updateLocation: function(id) {
            this.$http.put('/admin/location/update/' + id, this.newLocation).then(function() {
                this.fetchLocations();
                this.currentTab = 'list';
            });
        },
        
        deleteFood: function(id) {
            this.$http.delete('/admin/location/delete/' + id).then(function(){
                this.fetchLocations();
            });
        }
    }
});