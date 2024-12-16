new Vue({
    el: '#app',
    data: {
        name: "",
        email: "",
        gender: "",
        formSubmitted: false
    },
    methods: {
        submitForm: function () {
            this.formSubmitted = true;
        },
        resetForm:function(){
            this.name = "";
            this.email = "";
            this.gender = "";
            this.formSubmitted = false;
        },
    }
});
