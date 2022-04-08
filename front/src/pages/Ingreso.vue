<template>
<q-page class="q-pa-xs">
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4">
      <q-form @submit="login">
        <div class="row">
          <div class="col-12"><q-input dense outlined label="email" v-model="email" /></div>
          <div class="col-12"><q-input type="password" dense outlined label="password" v-model="password" /></div>
          <div class="col-12"><q-btn type="submit" class="full-width" label="Ingresar" icon="login" color="positive" /></div>
        </div>
      </q-form>
    </div>
    <div class="col-4"></div>
  </div>

</q-page>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Ingreso",
  data(){
    return{
      email:'admin@test.com',
      password:'123'
    }
  },
  methods:{
    login(){
      this.$q.loading.show()
      this.$store.dispatch('login/login', { email:this.email, password:this.password })
        .then(() =>{
          this.$q.loading.hide()
          this.$router.push('/')
        })
        // .catch(err => {
        //   this.$q.loading.hide();
        //   console.log(err)
        //   // this.$q.notify({
        //   //   message:err,
        //   //   color:'red',
        //   //   icon:'error'
        //   // })
        // })
    }
  }
}
</script>

<style scoped>

</style>
