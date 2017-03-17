@extends('layouts.app')

@section('content')
<div id="map"></div>
<div class="container" id="admin">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" v-bind:class="{ active: currentParentTab == 'location' }"><a href="#location">Location</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <div id="location" v-if="currentParentTab == 'location'">
                <ul class="nav nav-pills nav-justified shadow-kit">
                    <li role="presentation" v-bind:class="{ active: currentTab == 'list' }"><a href="#list" name="list" v-on:click="changeTab">List</a></li>
                    <li role="presentation" v-bind:class="{ active: currentTab == 'form' }"><a href="#add" name="form" v-on:click="changeTab">@{{ action }}</a></li>
                </ul>
                <table v-if="currentTab == 'list'" class="table table-hover shadow-kit">
                    <tr>
                        <td>Name</td>
                        <td>Photo</td>
                        <td>Actions</td>
                    </tr>
                    <tr v-for="location in locations">
                        <td>@{{ location.name }}</td>
                        <td><img class="img-responsive table-image" :src="location.photo_url" /></td>
                        <td>
                            <button class="btn btn-success" v-on:click="editLocation(location.id)">Edit</button>
                        </td>
                    </tr>
                </table>
    
                <form method="POST" v-if="currentTab == 'form'" v-on:submit.prevent="onSubmitForm">
                    <button v-on:click="pullFromGoogle" class="btn btn-success">Pull From Google Place API</button>
                    <div class="form-group" v-if="newLocation.google_place_id == ''">
                        <label for="">Search Location to add</label>
                        <input type="text" name="location" class="form-control" v-model="searchLocation" />
                        <ul v-for="loc in searchLocations">
                            <li class="" v-on:click="selectLocation(loc)">@{{loc.name}} @{{loc.formatted_address}}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="">Name <span class="error" v-if="!newLocation.name">*</span></label>
                        <input type="text" name="name" class="form-control" v-model="newLocation.name" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Photo <span class="error" v-if="!newLocation.photo_url">*</span></label>
                            <input type="text" name="photo_url" class="form-control" v-model="newLocation.photo_url" />
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Select photo from Google</button>
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" :src="newLocation.photo_url" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address <span class="error" v-if="!newLocation.address">*</span></label>
                        <input type="text" name="address" class="form-control" v-model="newLocation.address" />
                    </div>
                    <div class="form-group">
                        <label for="">Latitue <span class="error" v-if="!newLocation.lat">*</span></label>
                        <input type="text" name="lat" class="form-control" v-model="newLocation.lat" />
                    </div>
                    <div class="form-group">
                        <label for="">Longitude <span class="error" v-if="!newLocation.lng">*</span></label>
                        <input type="text" name="lng" class="form-control" v-model="newLocation.lng" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-default" :value="action" />
                    </div>
                </form>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-3" v-for="photo in newLocation.photos">
                                    <img :src="photo" class="img-responsive" v-on:click="selectPhoto(photo)" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="confirmPhoto">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection