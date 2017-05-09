@extends('layouts.app')

@section('content')
<div id="map"></div>
<div class="container" id="dashboard">
    <h1>@{{ heading }}</h1>
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" v-bind:class="{ active: currentParentTab == 'food' }"><a href="#food">Food</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <div id="food" v-if="currentParentTab == 'food'">
                <ul class="nav nav-pills nav-justified shadow-kit">
                    <li role="presentation" v-bind:class="{ active: currentTab == 'list' }"><a href="#list" name="list" v-on:click="changeTab">List</a></li>
                    <li role="presentation" v-bind:class="{ active: currentTab == 'form' }"><a href="#add" name="form" v-on:click="changeTab">@{{ action }}</a></li>
                </ul>
                <table v-if="currentTab == 'list'" class="table table-hover shadow-kit">
                    <tr>
                        <td>Name</td>
                        <td>Photo</td>
                        <td>Price</td>
                        <td>Rating</td>
                        <td>Actions</td>
                    </tr>
                    <tr v-for="food in foods">
                        <td>@{{ food.name }}</td>
                        <td><img class="img-responsive table-image" :src="food.photo_url" /></td>
                        <td>$@{{ food.price }}</td>
                        <td>@{{ food.rating }}</td>
                        <td>
                            <button class="btn btn-success" v-on:click="editFood(food.id)">Edit</button>
                            <button class="btn btn-warning" v-on:click="deleteFood(food.id)">Delete</button>
                        </td>
                    </tr>
                </table>
                <form method="POST" v-if="currentTab == 'form'" v-on:submit.prevent="onSubmitForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name <span class="error" v-if="!newFood.name">*</span></label>
                        <input type="text" name="name" class="form-control" v-model="newFood.name" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Photo <span class="error" v-if="!newFood.photo_url">*</span></label>
                            <input type="text" name="photo_url" class="form-control" v-model="newFood.photo_url" />
                            <!--<input type="file" name="photo_url" class="form-control" />-->
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" :src="newFood.photo_url" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Price <span class="error" v-if="!newFood.price">*</span></label>
                        <input type="text" name="price" class="form-control" v-model="newFood.price" />
                    </div>
                    <div class="form-group">
                        <label for="">Rating <span class="error" v-if="!newFood.rating">*</span></label>
                        <input type="text" name="rating" class="form-control" v-model="newFood.rating" />
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" name="location" class="form-control" v-model="searchLocation" />
                        <ul v-for="location in locations">
                            <li v-on:click="selectLocation(location)">@{{location.name}} @{{location.formatted_address}}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-default" :value="action" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection