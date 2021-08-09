<template>
	<div class="row just-cent position-relative">
		<div class="col-md-12 col-lg-12" id="cart">
			<div
				class="checkout-card cart-mobile w-80"
				:class="showCart == true ? 'd-block' : ''"
				style="background-color: #fff"
			>
				<div class="page-top">
					<h3 class="text-center">Il tuo ordine</h3>
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
						class="cart-empty text-center"
						:class="$store.state.cartCount == 0 ? 'd-block' : 'd-none'"
					>
						<h5>Il tuo carello è vuoto!</h5>
					</div>
					<div
						class="cart-item"
						v-for="item in $store.state.cart"
						:key="item.id"
					>
						<div class="dish-cover">
							<div
								class="dish-cover-image"
								:style="`background-image: url('${item.image}')`"
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
						class="cart-sum mt-3"
						:class="$store.state.cartCount != 0 ? 'd-block' : 'd-none'"
					>
						<span>Prodotti nel carello: {{ $store.state.cartCount }}</span>
						<p>Totale: €{{ totalPrice }}</p>
					</div>
					<div
						class="mt-4 text-center"
						:class="$store.state.cartCount != 0 ? 'd-block' : 'd-none'"
					>
						<a href="/orders">
							<button class="my-button my-button-orange">
								Vai alla cassa
							</button></a
						>
						<button class="mybutton my-button-red mt-3" @click="emptyCart">
							Svuota il carello</button
						><br />
					</div>
				</div>
			</div>

			<a class="my-button-responsive-hide button-anchor" @click="reverseCart()">
				<i class="fas fa-shopping-cart"></i>
				<div
					class="badge-cart"
					:class="$store.state.cartCount != 0 ? 'd-flex' : 'd-none'"
				>
					<span>{{ $store.state.cartCount }}</span>
				</div>
			</a>
		</div>
		<div
			class="overlay-cart"
			:class="showCart == true ? 'd-block' : ''"
			@click="reverseCart()"
		></div>
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
			id: window.id,
			slug: window.slug,
		};
	},
	mounted() {
		localStorage.setItem("slug", JSON.stringify(this.slug));
	},
	computed: {
		totalPrice() {
			let total = 0;

			for (let item of this.$store.state.cart) {
				total += item.totalPrice;
			}

			return parseFloat(total).toFixed(2);
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
