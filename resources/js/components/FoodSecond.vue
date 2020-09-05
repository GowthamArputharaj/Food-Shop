<template>
    <div class="row w-75 mx-auto ">
        
        <h3> Food Item List</h3>

        <table class="table table-striped table-hover col-12 ">
            <thead>
            <tr>
                <th>Food name</th>
                <th>Food price</th>
                <th>Food quantity</th>
            </tr>
            </thead>
                <tbody v-for="food_list of this.foods"  v-bind:key="food_list.id">
                    <tr>
                        <td class="">{{food_list.food_item}}</td>
                        <td class="">{{food_list.food_price}} $ </td>
                        <td class="">
                                {{food_list.food_quantity}}
                        </td>
                        <td class="">
                            <input type="button" value="Add to card" 
                                    v-on:click="add_to_cart(food_list.food_item, 1, food_list.food_price, food_list.food_quantity);  if(food_list.food_quantity > 0){food_list.food_quantity = food_list.food_quantity - 1;} else { }">
                        </td>

                        <td class="">
                            <input type="button" value="Remove from card" 
                                    v-on:click="remove_from_cart(food_list.food_item, -1, food_list.food_price, food_list.food_quantity);">
                        </td>
                    </tr>
            </tbody>
        </table>

        <h3> Food in Cart List</h3>
        <table class="table table-striped table-hover col-12 ">
            <thead>
            <tr>
                <th>Food name</th>
                <th>Food quantity</th>
                <th>Food price</th>
            </tr>
            </thead>
            <tbody v-for="food_list of userfoods"  v-bind:key="food_list.id">
                    <tr v-if="food_list[1] > 0">
                        <td class="">{{food_list[0]}}</td>
                        <td class="">{{food_list[1]}}</td>
                        <td class="">{{food_list[2]}}</td>
                        <td><input type="button" value="Delete from cart"
                                v-on:click="del_from_cart(food_list[0])"></td>
                    </tr>
            </tbody>
            <br>
            <tr>
                <th>Total</th>
                <th></th>
                <th><input type="text" v-bind:value="this.total" disabled></th>
            </tr>
        </table>

        <input type="button" value="buy" class="btn btn-success col float-right" v-on:click="buy()"/>
        
    </div>
</template>

<script>
    export default {
    // var vm = new Vue({
        name: 'products',
        data() {
            return {
                response: '',
                foods: '',
                userfoods: [],
                quantity: 1,
                total: 0
            }
        },
        computed: {
           loaduserfoods:  function () {
                return userfoods;
            }
        },
        created: async function() {

            this.foods = this.foods = await axios.get('/foods')
                .then(resp => {
                    return resp.data;
                })
                .catch(error => console.log(error));

            this.userfoods = await axios.get('/cart')
                .then(resp => {
                    return resp.data;
                })
                .catch(error => console.log(error));
        },
        methods: {
            add_to_cart(item, value, price, quantity) {            
                for(let i = 0; i < this.userfoods.length; i++)
                {
                    if(this.userfoods[i][0].indexOf(item) > -1)
                    {
                        var foodindex = this.foods.filter(food => food.food_item == item);
                        if(parseInt(foodindex[0].food_quantity) >= value)
                        {
                            // updating the quantity
                            this.userfoods[i][1] =  parseInt(this.userfoods[i][1]) + parseInt(value);
                            this.userfoods = this.userfoods.filter(function(food) {
                                // console.log(food);
                                return food;
                            });

                            // updating the price
                            this.userfoods[i][2] =  parseInt(this.userfoods[i][1]) * parseFloat(price);
                        }
                    } 
                }

                this.userfoods = this.userfoods.filter(function(food) {
                    // console.log(food);
                    return food;
                });

                this.total = 0
                for(let i = 0; i < this.userfoods.length; i++)
                {
                    this.total = this.total + this.userfoods[i][2];
                }

                console.log("added to cart")

            },
            remove_from_cart(item, value, price, quantity)
            {
                for(let i = 0; i < this.userfoods.length; i++)
                {
                    if(this.userfoods[i][0].indexOf(item) > -1)
                    {
                        var foodindex = this.foods.filter(food => food.food_item == item);
                        
                        if((quantity >= 0) && this.userfoods[i][1] > 0)
                        {
                            // updating the quantity
                            this.foods[foodindex[0].id - 1].food_quantity = this.foods[foodindex[0].id - 1].food_quantity + 1;
                            this.userfoods[i][1] =  parseInt(this.userfoods[i][1]) + parseInt(value);
                            
                            this.userfoods = this.userfoods.filter(function(food) {
                                return food;
                            });

                            // updating the price
                            this.userfoods[i][2] =  parseInt(this.userfoods[i][1]) * parseFloat(price);

                        }
                    } 
                }

                this.userfoods = this.userfoods.filter(function(food) {
                    return food;
                });

                this.total = 0
                for(let i = 0; i < this.userfoods.length; i++)
                {
                    this.total = this.total + this.userfoods[i][2];
                }

                console.log("removed from cart")

            },
            
            async buy() {
                var url = `/buy`;
                var response = await axios.post(url, {
                        userfoods: this.userfoods
                    })
                    .then(resp => {
                        // console.log(resp.data);
                        return resp.data;
                    })
                    .catch( function(error) {
                        if(error.response.status == 401){
                            window.location.href = "/login";
                        }
                    });
                
                for(let i = 0; i < this.userfoods.length; i++)
                {
                    this.userfoods[i][1] = 0;
                    this.userfoods[i][2] = 0;
                }

                this.userfoods = this.userfoods.filter(function(food) {
                    return food;
                });
                    
                this.total = 0

                console.log("stored to DB");
            },
            del_from_cart(item)
            {
                // console.log("del from cart", item );
                var foodindex = this.foods.filter(food => food.food_item == item);

                for(let i = 0; i < this.userfoods.length; i++)
                {
                    if(this.userfoods[i][0].indexOf(item) > -1)
                    {
                        // updating the quantity of foods list table
                        this.foods[foodindex[0].id - 1].food_quantity = this.userfoods[i][1] + this.foods[foodindex[0].id - 1].food_quantity;

                        // removing the product from cart
                        this.userfoods[i][1] =  parseInt(0);
                        
                        this.total = 0;
                        for(let i = 0; i < this.userfoods.length; i++)
                        {
                            if( this.userfoods[i][0] != item)
                            {
                                this.total = this.total + this.userfoods[i][2];
                            }
                        }

                        // updating the price of product in cart
                        this.userfoods[i][2] =  parseFloat(0);
                        
                    } 
                }

                this.userfoods = this.userfoods.filter(function(food) {
                    return food;
                });
            }
        }
    }
</script>