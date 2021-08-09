
const stats = new Vue({
    el: '#stats',
    data: {
        year: new Date().getFullYear(),
        id: window.id,
    },
    methods: {

        filterByYear() {
            let monthsPrice = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let yearPrice = 0;
            let orderTotalPrice = [];


            axios
                .get(`http://localhost:8000/api/totalForMonth/${this.id}`)
                .then(
                    (response) => {

                        let orders = response.data.response;
                        console.log(orders);





                        var ctx = document.getElementById('chart').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',

                            data: {
                                labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                                datasets: [{
                                    label: "Guadagno totale (in valuta EU)  " ,
                                    backgroundColor: 'rgba(255, 168, 3 , 0.4)',
                                    borderColor: 'rgb(255, 168, 3)',
                                    data: orders ,
                                }]
                            },
                            options: {
                                legend: {
                                    labels: {
                                        // This more specific font property overrides the global property
                                        fontSize: 16,
                                    }
                                },
                            }

                        });

                    });
        }
    },

    mounted() {
        this.filterByYear();
    }
});
