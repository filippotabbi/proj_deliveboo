<template>
  <div class="row">
    <div
      class="col-md-12 col-lg-12 col-xl-6 mt-2 card-outline cursor-pointer"
      v-for="item in items"
      :key="item.id"
    >
      <div class="card-personal scale" @click="addToCart(item)">
        <div
          class="card-personal-cover position-relative"
          :style="`background-image:url('${item.image}')`"
        >
          <div class="card-personal-description">
            <p class="text-center">{{ item.description }}</p>
          </div>
        </div>

        <div class="card-personal-title">
          <h4>{{ item.name }}</h4>
          <div class="dish-price">
            <i class="fas fa-cart-plus"></i>
            <h5>€{{ item.price.toFixed(2) }}</h5>
            <i
              class="fas fa-circle"
              :class="item.available == 1 ? 'text-green' : 'text-red'"
            ></i>
          </div>
        </div>
      </div>
    </div>
    <!-- Delete pop up
    <div class="delete-container" :class="deleteForm ? 'd-flex' : ''">
      <div class="delete-form">
        <h4>
          Vuoi cancellare il tuo precedente carrello e iniziare il tuo ordine in
          questo ristorante??
        </h4>
        <div class="buttons mt-3">
          <a
            type="button"
            name="button"
            class="my-button my-button-green"
            @click="deleteCart()"
            >svuota carrekki</a
          >
          <a
            type="button"
            name="button"
            class="my-button my-button-green"
            href="/"
            @click="deleteForm = false"
            >Torna indietro</a
          >
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      //deleteForm: false,
      id: window.id,
      items: [],
    };
  },

  methods: {
    addToCart(item) {
      this.$store.commit("addToCart", item);
    },
    // deleteCart() {
    //   this.deleteForm = false
    //   localStorage.clear();
    //   location.reload();
    // },
    //     deleteCart() {
    //   this.deleteForm = false
    //   localStorage.clear();
    //   location.reload();
    // },
  },
  created() {
    axios
      .get(`http://localhost:8000/api/dishes/${this.id}`)
      .then((response) => {
        var dishes = response.data.response;

        dishes.forEach((dish) => {
          dish.price = parseFloat(dish.price);
          this.items.push(dish);
        });
      });
    // var oldOrder = JSON.parse(localStorage.getItem("cart"))[0];
    // if (this.id == oldOrder.restaurant_id) {
    // } else {
    //   this.deleteForm = true;
    // }
  },
};
</script>
