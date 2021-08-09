let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');


let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
    },

    mutations: {
        addToCart(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            if (state.cartCount > 0) {
                if (item.restaurant_id == state.cart[0].restaurant_id) {
                    if (found) {
                        found.quantity++;
                        found.totalPrice = found.quantity * found.price;
                    } else {
                        state.cart.push(item);

                        Vue.set(item, 'quantity', 1);
                        Vue.set(item, 'totalPrice', item.price);
                    }

                    state.cartCount++;
                }
            } else {
                if (found) {
                    found.quantity++;
                    found.totalPrice = found.quantity * found.price;
                } else {
                    state.cart.push(item);

                    Vue.set(item, 'quantity', 1);
                    Vue.set(item, 'totalPrice', item.price);
                }

                state.cartCount++;
            }

            this.commit('saveCart');
        },

        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            let found = state.cart.find(product => product.id == item.id);

            if (found && found.quantity > 1) {
                found.quantity--;
                found.totalPrice = found.quantity * found.price;
            } else {
                state.cart.splice(index, 1);
            }

            state.cartCount--


                this.commit('saveCart');
        },

        emptyCart(state) {
            state.cart = [];
            state.cartCount = 0;
            this.commit('saveCart');
        },
        changeQuantity(state, item) {
            let index = state.cart.indexOf(item);

            let found = state.cart.find(product => product.id == item.id);

            found.totalPrice = found.quantity * found.price;
            found.quantity = item.quantity;

            let sum = 0;
            state.cart.forEach(element => {
                sum = sum + parseInt(element.quantity);
            });

            state.cartCount = sum;

            if (found.quantity == 0) {
                state.cart.splice(index, 1);
            }

            this.commit('saveCart')
        },

        removeItemFromCart(state, item) {
            let index = state.cart.indexOf(item);

            let found = state.cart.find(product => product.id == item.id);

            state.cartCount = state.cartCount - found.quantity;

            state.cart.splice(index, 1);

            this.commit('saveCart');
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },


    },

};

export default store;
