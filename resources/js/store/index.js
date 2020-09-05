import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        foods: [],
        userfoods: [],
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
        // 
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
        async loadtempFoods(context ) {

            var url = `http://127.0.0.1:8000/food-load-item/`;
            var temp = await axios.get(url)
                .then(resp => {
                    // console.log(resp.data);
                    return resp.data;
                })
                .catch(error => console.log(error, 'Gowtham'));

            this.userfoods = temp;
            // console.log('temp is ' , temp, this.userfoods);

            return temp;
        },
        async buy(context) {
            console.log('incrementing '+ this.userfoods );
            var url = `http://127.0.0.1:8000/food-buy/`;
            var temp = await axios.post(url, {
                    userfoods: this.userfoods
                })
                .then(resp => {
                    // console.log(resp.data);
                    return resp.data;
                })
                .catch( function(error) {
                    console.log(error.response.status, 'Login to purchase');
                    if(error.response.status == 401){
                        window.location.href = "http://127.0.0.1:8000/login";
                    }
                });

            return temp;
        }
    }
});