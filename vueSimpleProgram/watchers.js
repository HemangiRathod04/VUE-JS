const app = new Vue({
    el: '#app',
    data() {
        return {
            username: ''
        };
    },
    watch: {
        username(newValue, oldValue) {
            console.log('username changed for ${newValue}, ${newValue}');
        }
    }
});