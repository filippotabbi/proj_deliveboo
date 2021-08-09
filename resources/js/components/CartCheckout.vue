<template>
	<div
		id="cart"
		class="checkout-card"
		:class="showCart == true ? 'd-block' : ''"
	>
		<div class="page-top">
			<h2>Riepilogo ordine</h2>
			<div class="my-buttons-container">
				<button
					class="my-button my-button-orange"
					:class="$store.state.cartCount != 0 ? 'd-block' : 'd-none'"
					@click="clickEditCart = !clickEditCart"
				>
					<i class="fas fa-edit"></i>
				</button>
			</div>
		</div>
		<div class="cart-inner">
			<div
				class="cart-empty text-center mb-3"
				:class="$store.state.cartCount == 0 ? 'd-block' : 'd-none'"
			>
				<h5>Il tuo carello è vuoto!</h5>
			</div>
			<div class="cart-item" v-for="item in $store.state.cart" :key="item.id">
				<div class="dish-cover">
					<div
						class="dish-cover-image"
						:style="`background-image: url('${item.image}');`"
					>
						<div class="dish-cover-overlay" v-if="clickEditCart">
							<i class="fas fa-times" @click="removeItemFromCart(item)"></i>
						</div>
					</div>
					<div class="dish-name ml-3">
						<span>{{ item.name }}</span>
						<div class="dish-quantity">
							<i class="fas fa-minus" @click="removeFromCart(item)"></i>
							<span
								@click="setManually(item.id)"
								v-if="item.id != currentId"
								class="ml-1 mr-1 cursor-pointer"
								>{{ item.quantity }}</span
							>
							<input
								v-if="item.id == currentId"
								autofocus
								@focus="$event.target.select()"
								class="set-quantity"
								type="number"
								:value="item.quantity"
								v-on:keyup.enter="changeQuantity(item, $event)"
							/>
							<i class="fas fa-plus" @click="addToCart(item)"></i>
						</div>
					</div>
				</div>
				<div class="dish-price">
					<span>€{{ item.totalPrice }}</span>
				</div>
			</div>

			<div
				class="cart-sum"
				:class="$store.state.cartCount != 0 ? 'd-block' : 'd-none'"
			>
				<span>Prodotti nel carello: {{ $store.state.cartCount }}</span>
				<h4 style="font-weight: 700">Totale: €{{ totalPrice }}</h4>
			</div>
			<div class="text-center">
				<a :href="`/restaurants/${this.restaurantSlug}`">
					<button class="my-button my-button-orange">
						Torna al ristorante
					</button></a
				>

				<button
					class="mybutton my-button-red mt-3"
					@click="emptyCart"
					:class="$store.state.cartCount != 0 ? 'd-inline' : 'd-none'"
				>
					Svuota il carello</button
				><br />
			</div>
		</div>
	</div>
</template>


<script>
export default {
	data() {
		return {
			clickQuantity: false,
			currentId: null,
			newQuantity: null,
			clickEditCart: false,
			showCart: false,
			restaurantSlug: "",
		};
	},
	mounted() {
		this.restaurantSlug = JSON.parse(localStorage.getItem("slug"));
	},
	computed: {
		totalPrice() {
			let total = 0;

			for (let item of this.$store.state.cart) {
				total += item.totalPrice;
			}

			return total.toFixed(2);
		},
	},

	methods: {
		addToCart(item) {
			this.$store.commit("addToCart", item);
		},
		removeFromCart(item) {
			this.$store.commit("removeFromCart", item);
		},
		emptyCart() {
			this.$store.commit("emptyCart");
		},
		setManually(item) {
			this.currentId = item;
		},
		setManuallyDone(item) {
			this.$store.commit("setManuallyDone", item);
		},
		changeQuantity(item, event, state) {
			item.quantity = event.target.value; // Actual assignment
			this.currentId = null;

			this.$store.commit("changeQuantity", item);
		},
		removeItemFromCart(item) {
			this.$store.commit("removeItemFromCart", item);
			this.clickEditCart = false;
		},
		reverseCart() {
			this.showCart = !this.showCart;
		},
	},
};
</script>
