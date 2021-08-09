<template>
	<div class="col-md-12 col-lg-12" id="cart">
		<div class="cart-inner-no-padding">
			<div
				class="cart-empty text-center"
				:class="$store.state.cartCount == 0 ? 'd-block' : 'd-none'"
			>
				<h5>Il tuo carello è vuoto!</h5>
			</div>
			<div class="cart-item" v-for="item in $store.state.cart" :key="item.id">
				<div class="dish-cover">
					<!-- <img :src="item.image" :alt="item.name" /> -->

					<div
						class="dish-cover-image"
						:style="`background-image: url('${item.image}');`"
					>
						<div class="dish-cover-overlay">
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
								class="ml-1 mr-1"
								>{{ item.quantity }}</span
							>
							<input
								v-if="item.id == currentId"
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
				<button class="my button my-button-red mt-3" @click="emptyCart">
					Svuota il carello</button
				><br />
			</div>
		</div>
	</div>
</template>



<style>
.removeBtn {
	margin-right: 1rem;
	color: red;
}
</style>

<script>
export default {
	data() {
		return {
			clickQuantity: false,
			currentId: null,
			newQuantity: null,
			amount: null,
		};
	},
	computed: {
		totalPrice() {
			let total = 0;

			for (let item of this.$store.state.cart) {
				total += item.totalPrice;
			}

			this.$root.amount = total.toFixed(2);
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
			// this.clickQuantity = !this.clickQuantity;
		},
		setManuallyDone(item) {
			this.$store.commit("setManuallyDone", item);
		},
		changeQuantity(item, event, state) {
			item.quantity = event.target.value; // Actual assignment
			// this.newQuantity = item.quantity;
			this.currentId = null;

			this.$store.commit("changeQuantity", item);
		},
		removeItemFromCart(item) {
			this.$store.commit("removeItemFromCart", item);
		},
	},
};
</script>
