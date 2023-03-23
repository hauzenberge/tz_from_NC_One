<!DOCTYPE html>
<html>

<head>
    <title>VueJS Example</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div id="app">
            <form @submit.prevent="filterHouses" class="form-inline">
                <div class="mb-3 mx-2">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" class="form-control" v-model="filter.name">
                </div>
                <div class="mb-3 mx-2">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" id="price-min" class="form-control" v-model.number="filter.price[0]">
                    <input type="number" id="price-max" class="form-control" v-model.number="filter.price[1]">
                </div>
                <div class="mb-3 mx-2">
                    <label for="bedrooms" class="form-label">Bedrooms:</label>
                    <input type="number" id="bedrooms" class="form-control" v-model.number="filter.bedrooms">
                </div>
                <div class="mb-3 mx-2">
                    <label for="storeys" class="form-label">Storeys:</label>
                    <input type="number" id="storeys" class="form-control" v-model.number="filter.storeys">
                </div>
                <div class="mb-3 mx-2">
                    <label for="garages" class="form-label">Garages:</label>
                    <input type="number" id="garages" class="form-control" v-model.number="filter.garages">
                </div>
                <button type="submit" class="btn btn-primary mx-2 mb-3">Apply Filter</button>
            </form>

            <h1>List of Houses</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Badrooms</th>
                        <th>Storeys</th>
                        <th>Garages</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="house in houses" :key="house.id">
                        <td>@{{ house.name }}</td>
                        <td>@{{ house.price }}</td>
                        <td>@{{ house.badrooms }}</td>
                        <td>@{{ house.storeys }}</td>
                        <td>@{{ house.garages }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        var app = new Vue({
            el: '#app',
            data: {
                houses: [],
                url: '<?php echo url('/api/houses') ?>',
                filter: {
                    name: '',
                    price: [null, null],
                    bedrooms: null,
                    storeys: null,
                    garages: null
                }
            },
            methods: {
                filterHouses() {
                    axios.post(this.url + '/filter', this.filter, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            this.houses = response.data;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            },
            mounted() {
                axios.post(this.url)
                    .then(response => {
                        this.houses = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        });
    </script>
</body>

</html>