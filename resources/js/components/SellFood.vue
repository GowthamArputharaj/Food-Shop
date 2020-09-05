<template>
    <div class="" id="sell">
        <h2 class="text-center text-monospace text-primary mt-4">Sell Food</h2>
        <form @submit.prevent="store()" method="post" class="w-75 rounded">
            <div class="row justify-content-center p-3 m-2 ">
                <label for="food_item" class="col-6">Item Name</label>
                <input type="text" name="food_item" v-model="food_item" placeholder="Food Name" class="col-6"> <br>
            </div>

            <div class="row justify-content-center p-3 m-2 ">
                <label for="food_price" class="col-6">price</label>
                <input type="text" name="food_price"  v-model="food_price" placeholder="Food Price"  class="col-6"> <br>
            </div>

            <div class="row justify-content-center p-3 m-2 ">
                <label for="food_quantity" class="col-6">quantity Number</label>
                <input type="number" name="food_quantity"  v-model="food_quantity" placeholder="Food Quantity"  class="col-6"> <br>
            </div>

            <input type="submit" value="submit" class="btn btn-success col float-right">
        </form>

    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Sell Product.');
        },
        data() {
            return {
                food_item: '',
                food_price: '',
                food_quantity: 0
            }
        },
        methods: {
            async store () {
                console.log("food_item",this.food_item,this.food_price,this.food_quantity);
                var response = await axios.post('http://127.0.0.1:8000/food/store', {
                        data: [this.food_item,this.food_price,this.food_quantity]
                    })
                    .then(resp => {
                        console.log("resp . data ",resp);
                        return resp.data;
                    })
                    .catch( function(error) {
                        // console.log(error.response.status, 'Login to purchase');
                        console.log('status code is ....', error.response.status)
                        if(error.response.status == 401){
                            window.location.href = "http://127.0.0.1:8000/login";
                        }
                    });
                
                // console.log('final resp ', response)
            }   
        }
    }
</script>

<style scoped>
#sell {
    height: 100vh;
}
form {
    margin: 10vh auto;
    /* margin-top: 20vh; */
    background: lightblue;
    padding: 10vh 0;
}
.col {
    margin-top: 10vh;
}
html {
    margin-bottom: 0;
    padding-bottom: 0;
}
</style>
