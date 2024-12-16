const app = Vue.createApp({

    data() {
        return {
            // detailsAreVisible:false,
            friends: [
                { id: '1', name: 'Manual lorenz', phone: '0968756478', email: 'Manual@gmail.com' ,detailsAreVisible: false},
                { id: '2', name: 'Manual lorenz', phone: '0968756478', email: 'Manual@gmail.com' ,detailsAreVisible: false},
                { id: '3', name: 'Manual lorenz', phone: '0968756478', email: 'Manual@gmail.com' ,detailsAreVisible: false},
                { id: '4', name: 'Manual lorenz', phone: '0968756478', email: 'Manual@gmail.com' ,detailsAreVisible: false},
                { id: '5', name: 'Manual lorenz', phone: '0968756478', email: 'Manual@gmail.com' ,detailsAreVisible: false},
            ],
        };
    },
    methods:{
        toggelDetails(index){
            this.friends[index].detailsAreVisible=!this.friends[index].detailsAreVisible;
        }
    }
});

app.mount('#app');