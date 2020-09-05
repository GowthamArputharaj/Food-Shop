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
                        <td class="">{{food_list.food_quantity}}</td>
                        <td class="">
                            <input type="button" value="Add to card" v-on:click="add_to_cart(food_list.food_item)">
                            <input type="button" value="Delete from card" v-on:click="del_from_cart(food_list.food_item)">
                        </td>
                    </tr>
            </tbody>
        </table>
        
        <!-- @{{ this.foods}} -->


        <h3> Food in Cart List</h3>
        <table class="table table-striped table-hover col-12 ">
            <thead>
            <tr>
                <th>Food name</th>
                <th>Food quantity</th>
            </tr>
            </thead>
            <tbody v-for="food_list of this.userfoods"  v-bind:key="food_list.id">
                    <tr>
                        <td class="">{{food_list[0]}}</td>
                        <td class="">{{food_list[1]}}</td>
                    </tr>
            </tbody>
        </table>

        @{{this.userfoods}}

    </div>
</template>

<script>
    export default {
        name: 'products',
        data() {
            return {
                response: '',
                foods: '',
                userfoods: ''
            }
        },
        created: async function() {
            this.foods = await this.$store.dispatch('loadFoods');

            this.userfoods = await this.$store.dispatch('loaduserFoods');

            // console.log(this.foods, typeof this.foods, this.foods[0][1]);
        },
        methods: {
            async add_to_cart($item) {
                this.$store.dispatch('adduserToCart', {item : $item} );

                this.userfoods = await this.$store.dispatch('loaduserFoods');
            },
            async del_from_cart($item) {
                this.$store.dispatch('deluserFromCart', {item : $item});

                this.userfoods = await this.$store.dispatch('loaduserFoods');
            }
            
        }
    }
</script>

