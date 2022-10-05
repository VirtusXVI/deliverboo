let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
    },

    mutations: {
        addToCart(state, menu) {
            let found = state.cart.find(product => product.id == menu.id);
        
            if (found) {
                found.quantity ++;
                found.totalPrice = found.quantity * found.price;
            } else {
                state.cart.push(menu);
        
                Vue.set(menu, 'quantity', 1);
                Vue.set(menu, 'totalPrice', menu.price);
            }
        
            state.cartCount ++;
            this.commit('saveCart');
        },

        removeFromCart(state, menu) {
            let index = state.cart.indexOf(menu);
        
            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;
        
                state.cart.splice(index, 1);

            }
            this.commit('saveCart');
        },

        decreaseQuantityFromCart(state, menu) {
            let index = state.cart.indexOf(menu);
        
            if (index > -1) {
                let product = state.cart[index];
        
                state.cartCount--;
                product.quantity --;

                if (product.quantity < 1) {
                    let index = state.cart.indexOf(menu);
        
                    if (index > -1) {
                        let product = state.cart[index];
                        state.cartCount -= product.quantity;
        
                        state.cart.splice(index, 1);

                    }
                    this.commit('saveCart');
                }
                Vue.set(menu, 'totalPrice', menu.price);
            }
            this.commit('saveCart');
        },

        increaseQuantityFromCart(state, menu) {
            let index = state.cart.indexOf(menu);
        
            if (index > -1) {
                let product = state.cart[index];
                state.cartCount ++;
                // state.cartCount += product.quantity;
                
                product.quantity ++;

                Vue.set(menu, 'totalPrice', menu.price);
            }
            this.commit('saveCart');
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        }
    }
};

export default store;


