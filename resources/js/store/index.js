import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        foods: [],
        userfoods: [],
        type: 'fruites',
        temp: ''
    },
    getters: {
        allfoods: state => {
            return state.foods;
        },
        userfoods: state => {
            return state.userfoods;
        }
    },
    mutations: {
        getallfoods: (state, foods)=> {
            console.log('before axios mutations')
            axios.post('api')
                // .then(response => console.log(response, 'response from store.js mutations'))
                .then(response => state.chats = response.data)
                .catch(error => console.log(error, 'Gowtham'))
            console.log('after axios mutations')
        },
        getuserfoods: (state, userfoods)=> {
            console.log('before axios mutations')
            axios.post('api')
                // .then(response => console.log(response, 'response from store.js mutations'))
                .then(response => state.chats = response.data)
                .catch(error => console.log(error, 'Gowtham'))
            console.log('after axios mutations')
        }
    },
    actions: {
        async loadFoods(context , state ) {
            this.foods = await axios.get('http://127.0.0.1:8000/food-api')
                .then(resp => {
                    // console.log(resp.data);
                    return resp.data;
                });
            // console.log(this.foods);
            return this.foods;
        },
        // async addToCart(context , item  ) {
        //     console.log('incrementing '+ item.item );
        //     var url = "http://127.0.0.1:8000/food-api/inc/"+item.item;
        //     var temp = await axios.put(url)
        //         .then(resp => {
        //             console.log(resp.data);
        //             return resp.data;
        //         })
        //         .catch(error => console.log(error, 'Gowtham'));

        //     console.log('temp is ' , temp);
        //     return context.dispatch('loadFoods');
        // },
        // async delFromCart(context, item ) {
        //     console.log('decrementing '+item.item);
        //     var url = "http://127.0.0.1:8000/food-api/dec/"+item.item;
        //     var temp = await axios.put(url)
        //         .then(resp => {
        //             // console.log(resp.data);
        //             return resp.data;
        //         })
        //         .catch(error => console.log(error, 'Gowtham'));
            
        //     return context.dispatch('loadFoods');
        // },
        async loaduserFoods(context , state ) {
            this.userfoods = await axios.get('http://127.0.0.1:8000/food-user-api')
                .then(resp => {
                    // console.log(resp.data);
                    return resp.data;
                });
            // console.log(this.foods);
            return this.userfoods;
        },
        async adduserToCart(context , item  ) {
            console.log('incrementing '+ item.item );
            var url = `http://127.0.0.1:8000/food-user-api/inc/${item.item}`;
            var temp = await axios.put(url)
                .then(resp => {
                    // console.log(resp.data);
                    return resp.data;
                })
                .catch(error => console.log(error, 'Gowtham'));
            // console.log('temp is ' , temp);
            return context.dispatch('loaduserFoods');
        },
        async deluserFromCart(context, item ) {
            console.log('decrementing '+item.item);
            var url = `http://127.0.0.1:8000/food-user-api/dec/${item.item}`;
            var temp = await axios.put(url)
                .then(resp => {
                    // console.log(resp.data);
                    return resp.data;
                })
                .catch(error => console.log(error, 'Gowtham'));
            // console.log('temp is ' , temp);
            return context.dispatch('loaduserFoods');
        }
    }
});