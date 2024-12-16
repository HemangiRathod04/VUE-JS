const app= Vue.createApp({
    data(){
        return{
            playerHealth:100,
            monsterHeath:100
        };
    },
    methods:{
        attackMonster(){
            Math.random()
        }
    }
});
app.mount('#game');